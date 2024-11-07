<h1 class="text-center pt-5">Cambiar contraseña de usuario #<?= $_GET['id'] ?> </h1>

<div class="row form-container mt-5">
    <div class="col-md-6 mx-auto ">
        <form action="<?= base_url ?>usuario/cambiarPassAdmin" method="POST" class="form-group"
            id="formularioReestablecerContra">
            <div class="row">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                <div class="form-group col-md-12">
                    <label for="password">Introduce la nueva contraseña para el usuario</label>
                    <input type="password" name="nuevaPassword" class="form-control" required id="passLogin">
                    <span class="error-message"></span>
                </div>
            </div>

            <div class="text-center mt-4 pb-5">
                <input type="submit" value="Reestablece su contraseña" class="btn btn-primary boton ">
            </div>
        </form>
        <script src="<?= base_url ?>assets/JS/nuevaPassAdmin.js"></script>