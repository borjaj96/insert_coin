<h1 class="text-center pt-5">Mi Perfil</h1>
<div class="col-12 enlaceHistorial">
    <a href="<?=base_url?>pedido/misPedidos" class="enlaceHistorial text-right">
        Ver historial de pedidos
    </a>
</div>

<!-- DATOS PRINCIPALES -->
<div class="row form-container mt-4 miPerfil">
    <div class="col-md-12 mx-auto">

        <div class="row d-flex">
            <div class="col-md-6">
                <div class="form-group">
                    <p><strong>Nombre: </strong><span><?php echo $usuario->nombre ?></span></p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <p><strong>Apellidos: </strong><span><?php echo $usuario->apellidos ?></span></p>
                </div>
            </div>
        </div>

        <div class="row d-flex">
            <div class="col-md-6">
                <div class="form-group">
                    <p><strong>Email: </strong><span><?php echo $usuario->email ?></span></p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <p><strong>DNI: </strong><span><?php echo $usuario->dni ?></span></p>
                </div>
            </div>
        </div>

        <div class="row d-flex">
            <div class="col-md-6">
                <div class="form-group">
                    <p><strong>Teléfono: </strong><span><?php echo $usuario->telefono ?></span></p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <p><strong>Dirección: </strong><span><?php echo $usuario->direccion ?></span></p>
                </div>
            </div>
        </div>

        <div class="row d-flex">
            <div class="col-md-6">
                <div class="form-group">
                    <p><strong>Provincia: </strong><span><?php echo $usuario->provincia ?></span></p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <p><strong>Localidad: </strong><span><?php echo $usuario->localidad ?></span></p>
                </div>
            </div>
        </div>

        <div class="row d-flex">
            <div class="col-md-6">
                <div class="form-group">
                    <p><strong>CP: </strong><span><?php echo $usuario->cp ?></span></p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <p><strong>Tarjeta de crédito: </strong><span><?php echo $tarjetaFormateada?></span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between botonesMiPerfil">
        <div class="text-center col-6 mt-4 pb-5 botonDpers2">
            <a href="<?= base_url ?>usuario/datos_usuario">
                <input type="submit" value="Actualizar datos personales" class="btn btn-primary boton botonDpers">
            </a>
        </div>
        <div class="text-center col-6 mt-4 pb-5">
            <a href="<?= base_url ?>usuario/datos_pago">
                <input type="submit" value="Actualizar datos de pago" class="btn btn-primary boton">
            </a>
        </div>
    </div>

</div>
<script src="<?= base_url ?>assets/JS/miPerfil.js"></script>