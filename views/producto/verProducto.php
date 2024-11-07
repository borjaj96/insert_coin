<?php if (isset($prod)): ?>
  <div class="container">
  <a href="<?=base_url?>producto/index" class="flechaAtras "><i class="bi bi-arrow-left"></i></a>
    <div class="row">
      <div class="col-12">
      
        <h1 class="text-center pt-5 mb-5 nombreProducto"><?= $prod->nombre ?></h1>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-5 mb-5">
        <?php if ($prod->foto != null): ?>
          <img src="<?= base_url ?>assets/user_uploads/images/<?= $prod->foto ?>" alt="" class="fotoProducto">
        <?php else: ?>
          <img src="<?= base_url ?>assets/img/noFoto.png" alt="" class="fotoProducto">
        <?php endif; ?>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-12">
            <h1 class="nombreProducto2"><?= $prod->nombre ?></h1>
            <p class="ml-md-5 descripcionProducto"><?= $prod->descripcion ?></p>
            <p class="precioProducto"><?= $prod->precio ?>€</p>

            <?php if (isset($_SESSION['identity'])): ?>
              <!-- Si el usuario está logueado -->
              <?php if($_SESSION['identity']->id != $prod->vendedor_id):?>
                <?php if ($prod->estado == 'disponible'): ?>
                  <?php if(!isset($_SESSION['admin'])): ?>
                    <div class="botonCompra">
                      <a href="<?= base_url ?>carrito/add&id=<?= $prod->id ?>" >
                        <input type="submit" value="Comprar" class="btn btn-primary boton" id="agregar-al-carrito">
                      </a>
                    </div>
                  <?php endif; ?>
                <?php else: ?>
                  <img src="<?= base_url ?>assets/img/vendido.png" alt="vendido" class="fotoVendido">
                <?php endif; ?>

              <?php else: ?>
                <p class="negrita rojo">Suerte con la venta de tu producto!</p>
              <?php endif; ?>

            <?php else: ?>
              <!-- Si el usuario no está logueado -->
              <p class="negrita rojo">Inicia sesión para agregar productos al carrito.</p>
              <!-- Puedes agregar aquí el código para mostrar el formulario de inicio de sesión o redirigir al usuario a la página de inicio de sesión -->
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </div>

<?php else: ?>
  <h1 class="text-center pt-5">El producto no existe</h1>
<?php endif; ?>