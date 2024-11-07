<!-- NOTICIAS -->
<div class="d-flex flex-column flex-md-row flex-wrap">
    <div class="container bg-light col-md-6 col-sm-12 mt-4">
        <h1 class="text-center pt-5 pb-3">NOTICIAS</h1>

        <?php while($art = $articulos->fetch_object()) : ?>

            <div class="card mb-3 noticia" style="max-width: 540px;">
                <a href="<?=base_url?>articulo/ver&id=<?=$art->id?>">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center">
                            <img src="<?=base_url?>assets/uploads/images/<?=$art->foto?>"
                                class="img-fluid rounded-start fotoCardNoticia" alt="..." style="height: 100%;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?=$art->titulo?></h5>
                                <p class="card-text"><?= substr($art->descripcion, 0, 110) ?>...</p>
                                <p class="card-text"><small class="text-body-secondary">Publicado el
                                        <?=$art->fecha?></small></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endwhile;?>
    </div>