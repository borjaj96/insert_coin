<?php if(isset($categoria)):?>
    <div class="imagen-principal position-relative">
        <?php if($categoria->nombre == 'PS5'):?>
            <img class="d-block w-100" src="<?= base_url ?>assets/img/ps51.png" alt="First slide">
        <?php elseif($categoria->nombre == 'PC'):?>
            <img class="d-block w-100" src="<?= base_url ?>assets/img/pc.png" alt="First slide">
        <?php elseif($categoria->nombre == 'XBOX'):?>
            <img class="d-block w-100" src="<?= base_url ?>assets/img/xbox.jpeg" alt="First slide">
        <?php elseif($categoria->nombre == 'SWITCH'):?>
            <img class="d-block w-100" src="<?= base_url ?>assets/img/switch.jpg" alt="First slide">
        <?php endif;?>

        <div class="image-text">
            <h1><?=$categoria->nombre?></h1>
        </div>
    </div>

    <?php if($articulos->num_rows == 0):?>
        <h2 class="text-center pt-5 pb-3">Actualmente no hay noticias sobre éste tema</h2>
    <?php else: ?>

        <h2 class="text-center pt-5 pb-3">ÚLTIMAS NOTICIAS</h2>
        <div class="row">      
            <?php while($art = $articulos->fetch_object()) : ?>
                
                <div class="col-lg-4 col-md-6 col-sm-12 noticia">
                    <a href="<?=base_url?>articulo/ver&id=<?=$art->id?>">
                        <div class="card cardArticuloCategoria mb-4" style="max-width: 25rem;">
                            <img src="<?=base_url?>assets/uploads/images/<?=$art->foto?>" class="card-img-top " alt="...">
                            <div class="card-body noticia">
                                <h5 class="card-title"><?=$art->titulo?></h5>
                                <p class="card-text"><?= substr($art->descripcion, 0, 110) ?>...</p>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endwhile;?> 
        </div>  
    <?php endif; ?>
      
<?php else: ?>
    <h1 class="titulo">La categoría no existe</h1>
<?php endif; ?>