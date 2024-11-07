<!-- NOTICIA PRINCIPAL -->
  <?php $art = $articuloSlider1->fetch_object() ?>
  <div class="imagen-principal position-relative">
    <a href="<?=base_url?>articulo/ver&id=<?=$art->id?>">
      <img class="d-block w-100" src="<?=base_url?>assets/uploads/images/<?=$art->foto?>" alt="First slide">
      <div class="image-text">
        <h2 class="tituloNoticiaPrincipal"><?=$art->titulo?></h2>
        <p>&nbsp;</p>
      </div>
    </a>
  </div>