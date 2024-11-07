<!-- NOTICIAS DESTACADAS-->
<div class="container container-noticias bg-light">
    <h1 class="text-center pt-5 pb-3">DESTACAMOS</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4 col">

        <?php while($art = $articuloDestacado->fetch_object()) : ?>

            <div class="card text-bg-dark bg-transparent border-0 destacado">
                <a href="<?=base_url?>articulo/ver&id=<?=$art->id?>">
                    <div class="position-relative">
                        <img src="<?=base_url?>assets/uploads/images/<?=$art->foto?>" class="card-img destacado" alt="...">
                        <div class="card-img-overlay d-flex align-items-end">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?=$art->titulo?></h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        <?php endwhile;?>

    </div>
</div>