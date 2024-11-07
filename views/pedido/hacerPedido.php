<?php if($_SESSION['identity']):?>
<h1 class="text-center">Hacer pedido</h1>

<a href="<?=base_url?>carrito/index" class="flechaAtras "><i class="bi bi-arrow-left"></i></a>

<form action="<?=base_url?>pedido/add" method="POST" class="form-pago" id="formularioPago">
    <div class="d-flex flex-column flex-md-row flex-wrap mt-4 hacerPedido">

        <div class="container col-md-7 col-sm-12 mt-4 hacerPedido">
            <h3 class="text-center">Dirección de facturación</h3>

            <div class="d-flex p-4 flex-column flex-md-row flex-wrap">
                <div class="container col-md-6 col-sm-12 p-2">
                    <div class="form-group">
                        <label for="nombre" class="negrita">Nombre</label>
                        <p><?php echo $usuario->nombre?></p>
                        <!-- <input type="text" name="nombre" class="form-control" value="<?php echo $usuario->nombre?>"> -->
                    </div>
                    <div class="form-group mt-3">
                        <label for="nombre" class="negrita">Email</label>
                        <p><?php echo $usuario->email?></p>
                        <!-- <input type="text" name="nombre" class="form-control" value="<?php echo $usuario->email?>"> -->
                    </div>
                    <div class="form-group mt-3">
                        <label for="telefono" class="negrita">Telefono</label>
                        <p><?php echo $usuario->telefono?></p>
                        <!-- <input type="number" name="telefono" class="form-control" value="<?php echo $usuario->telefono?>"> -->
                    </div>
                    <div class="form-group mt-3">
                        <label for="direccion" class="negrita">Dirección</label>
                        <p><?php echo $usuario->direccion?></p>
                        <!-- <input type="text" name="direccion" class="form-control" value="<?php echo $usuario->direccion?>"> -->
                    </div>
                    <div class="form-group mt-3">
                        <label for="localidad" class="negrita">Localidad</label>
                        <p><?php echo $usuario->localidad?></p>
                        <!-- <input type="text" name="localidad" class="form-control" value="<?php echo $usuario->localidad?>"> -->
                    </div>
                </div>

                <div class="container col-sm-12 col-md-6 p-2">
                    <div class="form-group">
                        <label for="apellidos" class="negrita">Apellidos</label>
                        <p><?php echo $usuario->apellidos?></p>
                        <!-- <input type="text" name="apellidos" class="form-control" value="<?php echo $usuario->apellidos?>"> -->
                    </div>
                    <div class="form-group mt-3">
                        <label for="dni" class="negrita">DNI</label>
                        <p><?php echo $usuario->dni?></p>
                        <!-- <input type="text" name="dni" class="form-control" value="<?php echo $usuario->dni?>"> -->
                    </div>
                    <div class="form-group mt-3">
                        <label for="cp" class="negrita">CP</label>
                        <p><?php echo $usuario->cp?></p>
                        <!-- <input type="number" name="cp" class="form-control" value="<?php echo $usuario->cp?>"> -->
                    </div>
                    <div class="form-group mt-3">
                        <label for="provincia" class="negrita">Provincia</label>
                        <p><?php echo $usuario->provincia?></p>
                        <!-- <input type="text" name="provincia" class="form-control" value="<?php echo $usuario->provincia?>"> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container col-sm-12 col-md-5 mt-4 border ml-3">
            <h3 class="text-center">Datos de la tarjeta</h3>

            <div class="card-wrap seccionDatos">
                <div class="tarjeta card-front animate">
                    <div class="number">
                        <div class="label">Numero de tarjeta</div>
                        <span><?php echo $tarjetaFormateada;?></span>
                    </div>
                    <div class="owner-data">
                        <div class="name">
                            <div class="label">Titular de la tarjeta</div>
                            <div class="value"><?php echo $usuario->titular_tarjeta?></div>
                        </div>
                        <div class="validate validezTarjeta">
                            <div class="label">Validez</div>
                            <div class="value" id="value-validez"></div>
                        </div>
                    </div>
                    <div class="flag">
                        <img src="https://brand.mastercard.com/content/dam/mccom/brandcenter/thumbnails/mastercard_vrt_rev_92px_2x.png"
                            alt="mastercard">
                    </div>
                </div>
                <div class="tarjeta card-back animate">
                    <div class="bar"></div>
                    <div class="secret-code">
                        <div class="label">CVV</div>
                        <div class="value" id="value-cvv"></div>
                    </div>
                </div>
            </div>

            <div class="p-5 seccionTarjeta">
                <div class="form-group">
                    <label for="titularTarjeta" class="negrita">Titular de la tarjeta</label>
                    <p><?php echo $usuario->titular_tarjeta?></p>
                </div>

                <div class="form-group">
                    <label for="numeroTarjeta" class="negrita">Número de tarjeta</label>
                    <p><?php echo $tarjetaFormateada?></p>
                </div>

                <div class="form-group">
                    <label for="validezTarjeta" class="negrita">Validez</label>
                    <input type="month" name="validezTarjeta" class="form-control" id="">
                    <span class="error-message"></span>
                </div>

                <div class="form-group">
                    <label for="cvvTarjeta" class="negrita">CVV</label>
                    <input type="number" name="cvvTarjeta" class="form-control" id="cvvTarjeta">
                    <span class="error-message"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 text-center">
        <input type="submit" value="Finalizar compra" class="btn btn-success">
    </div>
</form>






<?php else:?>
<h1 class="text-center titulo">Debes estar logueado para hacer pedidos</h1>
<?php endif;?>