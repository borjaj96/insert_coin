<h1 class="text-center">Productos a la venta</h1>

<div class="d-flex flex-wrap justify-content-center justify-content-md-end">
    <div class="col-12 col-md-auto mb-2 btnSubirProducto">
        <a href="<?=base_url?>producto/crear" class="btn btn-warning btn-block">
            Subir un producto
        </a>
    </div>

    <div class="col-12 col-md-auto">
        <div class="d-flex justify-content-center justify-content-md-end gap-2">
            <a href="<?=base_url?>producto/gestion" class="btn btn-success">
                Todos los productos
            </a>
            <a href="<?=base_url?>producto/vendido" class="btn btn-danger">
                Vendidos
            </a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <?php while($prod = $productos->fetch_object()): ?>
        <div class="col-md-4 mb-4"> <!-- Agregamos una columna de 4 columnas de ancho y un margen inferior -->
            <div class="card h-100"> <!-- Agregamos la clase h-100 para que la tarjeta ocupe la altura completa -->
                <?php if($prod->foto != null):?>
                    <img class="card-img-top fotoCardProducto" src="<?=base_url?>assets/user_uploads/images/<?=$prod->foto?>" alt="Card image cap">
                <?php else:?>
                    <img class="card-img-top fotoCardProducto" src="<?=base_url?>assets/img/noFoto.png" alt="">
                 <?php endif;?>

                <div class="card-body">
                    <h5 class="card-title text-center"><?=$prod->nombre?></h5>
                    <p class="card-text text-center"><?=$prod->nombre_categoria?></p>
                    
                    <div class="text-center">
                        <!-- Si el producto esta disponible muestra el boton de comprar, si no sale vendido -->
                        <?php if ($prod->estado == 'disponible'): ?>
                            <p class="card-text text-center"><?=$prod->precio?>€</p>
                            <a href="<?=base_url?>producto/editar&id=<?=$prod->id?>" class="btn btn-warning">Editar</a>
                            <a onclick="confirmDeleteProducto(event)" href="<?=base_url?>producto/eliminar&id=<?=$prod->id?>" class="btn btn-danger">Borrar</a>
                        <?php else:?>
                            <?=$prod->precio?>€<img src="<?=base_url?>assets/img/vendido.png" alt="vendido" class="fotoVendidoGestion">
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile;?>  
</div>
<script src="<?= base_url ?>assets/JS/gestionProductos.js"></script>
