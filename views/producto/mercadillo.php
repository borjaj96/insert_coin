<div class="imagen-principal position-relative">
    <img class="d-block w-100" src="<?= base_url ?>assets/img/mercadillo.jpg" alt="First slide">
    <div class="image-text">
        <h1>MERCADILLO</h1>
    </div>
</div>

<div class="form-group col-md-12">
    <form action="<?= base_url ?>producto/filtrarPorCategoria" method="POST">
        <p for="categoriah" class="mt-4">
            <h2 class="text-center">Buscar por categoría</h2>
        </p>
        <?php $categorias = Utils::showCategoriasProducto(); ?>
        <select name="categoria" class="form-select">
            <option value="0" class="text-center">Todas las categorías</option>
            <?php while ($cat = $categorias->fetch_object()) : ?>
                <option class="text-center" value="<?= $cat->id ?>">
                    <?= $cat->nombre ?>
                </option>
            <?php endwhile; ?>
        </select>
        <div class="text-center">
            <input type="submit" value="Buscar" class="btn btn-outline-danger mt-2">
        </div>
    </form>
</div>


<div class="row mt-4">
    <?php
    $productosEncontrados = false; // Variable para rastrear si se encontraron productos

    while ($prod = $productos->fetch_object()) :
        if (isset($_GET['categoria']) && $_GET['categoria'] != '' && $prod->categoria_id != $_GET['categoria']) {
            continue;
        }

        $productosEncontrados = true; // Se encontró al menos un producto
        ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <?php if ($prod->foto != null) : ?>
                    <img class="card-img-top fotoCardProducto" src="<?= base_url ?>assets/user_uploads/images/<?= $prod->foto ?>" alt="Card image cap">
                <?php else : ?>
                    <img class="card-img-top fotoCardProducto" src="<?= base_url ?>assets/img/noFoto.png" alt="">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title text-center"><?= $prod->nombre ?></h5>
                    <p class="card-text text-center"><?= $prod->categoria_producto ?></p>
                    <p class="card-text text-center"><?= $prod->precio ?></p>
                    <div class="text-center">
                        <a href="<?= base_url ?>producto/ver&id=<?= $prod->id ?>" class="btn btn-warning">Ver producto</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php if (!$productosEncontrados) : ?>
    <h3 class="text-center mt-5">Aún no hay productos en esta categoría.</h3>
    <h2 class="text-center mb-5"><i class="bi bi-emoji-frown sad text-center"></i></h2>
<?php endif; ?>

<script src="<?= base_url ?>assets/JS/mercadillo.js"></script>
