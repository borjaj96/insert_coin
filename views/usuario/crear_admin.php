<h1 class="text-center pt-5">Crear usuario Administrador</h1>
<div class="text-center">
    <i class="bi bi-person-fill login"></i>
</div>


<div class="row form-container">
    <div class="col-md-6 mx-auto ">
        <form action="<?=base_url?>usuario/saveAdmin" method="POST" class="form-group" id="formularioCrearAdmin">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required id="nombreAdmin">
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" required id="apellidosAdmin">
                    <span class="error-message"></span>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required id="emailAdmin">
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" required id="passAdmin">
                    <span class="error-message"></span>
                </div>
            </div>

            <div class="text-center mt-4 pb-5">
                <input type="submit" value="Registrar administrador" class="btn btn-primary boton ">
            </div>
        </form>
    </div>
</div>
<script src="<?= base_url ?>assets/JS/crearAdmin.js"></script>