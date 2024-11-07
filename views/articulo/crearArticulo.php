<!-- Si existe la variable edit y art y art es un objeto edita articulo, si no crealo -->
<?php if(isset($edit) && isset($art) && is_object($art)): ?>
    <h1 class="text-center">Editar: <?= $art->titulo?></h1>
    <?php $url_action = base_url."articulo/saveArticulo&id=".$art->id;?>

<?php else:?>
    <h1 class="text-center">Crear artículo</h1>
    <?php $url_action = base_url."articulo/saveArticulo";?>
<?php endif;?>

<div class="row form-container">
    <div class="col-md-6 mx-auto">
        <form action="<?= $url_action ?>" method="POST" class="form-group" enctype="multipart/form-data" id="formularioArticulo">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="titulo">Titulo</label>
                    <input type="text" name="titulo" class="form-control" value="<?=isset($art) && is_object($art) ? $art->titulo : ''?>" required id="tituloArticulo">
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="categoria">Categoría</label>
                    <?php $categorias = Utils::showCategorias(); ?>
                    <select name="categoria" class="form-select">
                        <?php while($cat = $categorias->fetch_object()): ?>
                            <option value="<?=$cat->id?>"<?=isset($art) && is_object($art) && $cat->id == $art->categoria_id ? 'selected' : ''?>>
                                <?=$cat->nombre?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="localizacion">Localización</label>
                    <?php $localizaciones = Utils::showLocalizacion(); ?>
                    <select name="localizacion" class="form-select">
                        <?php while($loc = $localizaciones->fetch_object()): ?>
                            <option value="<?=$loc->id?>"<?=isset($art) && is_object($art) && $loc->id == $art->localizacion_id ? 'selected' : ''?>>
                                <?=$loc->nombre?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" cols="20" rows="20" class="form-control" id="descripcionArticulo"><?=isset($art) && is_object($art) ? $art->descripcion : ''?></textarea>
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="foto">Imagen</label>
                    <?php if(isset($art) && is_object($art) && !empty($art->foto)):?>
                        <p class="fotoSubida text-center">
                            <img src="<?=base_url?>assets/uploads/images/<?=$art->foto?>"  alt="">
                        </p>
                    <?php endif;?>
                    <input type="file" name="foto" class="form-control" id="fotoArticulo">
                    <span class="error-message"></span>
                </div>
            </div>

            <div class="text-center mt-4 pb-5">
                <input type="submit" value="Crear artículo" class="btn btn-primary boton ">
            </div>
        </form>
    </div>
</div>
<script src="<?= base_url ?>assets/JS/crearArticulo.js"></script>