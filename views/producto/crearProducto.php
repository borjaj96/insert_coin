<?php if(isset($edit) && isset($prod) && is_object($prod)):?>
    <h1 class="text-center">Editar producto: <?=$prod->nombre?></h1>
    <?php $url_action = base_url."producto/save&id=".$prod->id?>
<?php else:?>
    <h1 class="text-center">Subir nuevo producto</h1>
    <?php $url_action = base_url."producto/save" ?>
<?php endif;?>


<div class="row form-container">
    <div class="col-md-6 mx-auto crearProducto">
        <form action="<?=$url_action?>" method="POST" class="form-group" enctype="multipart/form-data" id="formularioProducto">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required value="<?=isset($prod) && is_object($prod) ? $prod->nombre : ''?>" id="nombreProducto">
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="categoria">Categoría</label>
                    <?php $categorias = Utils::showCategoriasProducto();?>
                    <select name="categoria" class="form-select">
                        <?php while($cat = $categorias->fetch_object()):?>
                            <option value="<?=$cat->id?>" <?=isset($prod) && is_object($prod) && $cat->id == $prod->categoria_id ? 'selected' : ''?>>
                                <?=$cat->nombre?>
                            </option>
                        <?php endwhile;?>   
                    </select>
                </div>
            </div>
 
            <div class="row">
                <div class="form-group col-md-12 mt-3">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" cols="20" rows="20" class="form-control" id="descripconProducto"><?=isset($prod) && is_object($prod) ? $prod->nombre : ''?></textarea>
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12 mt-3">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" class="form-control" required value="<?=isset($prod) && is_object($prod) ? $prod->precio : ''?>" id="precioProducto">
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="foto">Imagen</label>
                    <?php if(isset($prod) && is_object($prod) && !empty($prod->foto)):?>
                        <p class="fotoSubida text-center">
                            <img src="<?=base_url?>assets/user_uploads/images/<?=$prod->foto?>" alt="">
                        </p>
                    <?php endif; ?>
                    <input type="file" name="foto" class="form-control" id="fotoProducto">
                    <span class="error-message"></span>
                </div>
            </div>

            <div class="text-center mt-4 pb-5">
                <input type="submit" value="Subir producto" class="btn btn-primary boton ">
            </div>
        </form>
    </div>
</div>
<script src="<?= base_url ?>assets/JS/crearProducto.js"></script>