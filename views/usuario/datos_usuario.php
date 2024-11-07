<!-- DATOS PERSONALES -->

<?php if(isset($edit)): ?>
    <h2 class="text-center pt-5">Actualizar datos personales</h2>
<?php else: ?>
    <h2 class="text-center pt-5">Datos personales</h2>
<?php endif; ?>
<a href="<?=base_url?>usuario/miPerfil" class="flechaAtras "><i class="bi bi-arrow-left"></i></a>

<div class="row form-container mt'4">
    <div class="col-md-12 mx-auto">
        <form action="<?=base_url?>usuario/saveDatos" method="POST" class="form-group" id="formularioDatosUser">
            <div class="row d-flex">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" required
                            value="<?= $usuario->telefono?>" id="telefonoUser">
                        <span class="error-message"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" class="form-control" required
                            value="<?= $usuario->direccion?>" id="direccionUser">
                        <span class="error-message"></span>
                    </div>
                </div>
            </div>

            <div class="row d-flex">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <input type="text" name="provincia" class="form-control" required
                            value="<?= $usuario->provincia?>" id="provinciaUser">
                        <span class="error-message"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="localidad">Localidad</label>
                        <input type="text" name="localidad" class="form-control" required
                            value="<?= $usuario->localidad?>" id="localidadUser">
                        <span class="error-message"></span>
                    </div>
                </div>
            </div>

            <div class="row d-flex">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cp">CP</label>
                        <input type="text" name="cp" class="form-control" required value="<?= $usuario->cp?>"
                            id="cpUser">
                        <span class="error-message"></span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 pb-5">
                <input type="submit" value="Actualizar datos personales" class="btn btn-primary boton">
            </div>
        </form>
    </div>
</div>
<script src="<?= base_url ?>assets/JS/datos_usuario.js"></script>