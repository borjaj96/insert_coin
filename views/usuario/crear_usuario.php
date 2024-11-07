<h1 class="text-center pt-5">Crea tu cuenta</h1>
<div class="text-center">
    <i class="bi bi-person-fill login"></i>
</div>



<!-- borra la sesion -->
<?php Utils::deleteSession('register');?>

<div class="row form-container">
    <div class="col-md-6 mx-auto ">
        <form action="<?=base_url?>usuario/save" method="POST" class="form-group" id="formularioRegistro">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="nombre" class="mt-3">Nombre</label>
                    <input type="text" name="nombre" class="form-control mb-0" required id="nombreRegistro">
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="apellidos" class="mt-3">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control mb-0" required id="apellidosRegistro">
                    <span class="error-message"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="dni" class="mt-3">DNI</label>
                    <input type="text" name="dni" class="form-control mb-0" required id="dniUser">
                    <span class="error-message"></span>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="email" class="mt-3">Email</label>
                    <input type="email" name="email" class="form-control mb-0" required id="emailRegistro">
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="password" class="mt-3">Contraseña</label>
                    <input type="password" name="password" class="form-control mb-0" required id="passRegistro">
                    <span class="error-message"></span>
                </div>
            </div>

            <div class="text-center mt-4 pb-5">
                <input type="submit" value="Regístrate" class="btn btn-primary boton" id="crearUser">
            </div>
        </form>
    </div>
</div>
<script src="<?= base_url ?>assets/JS/crearUser.js"></script>