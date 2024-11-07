<h1 class="text-center pt-5">Reestablece tu contraseña</h1>

<div class="row form-container mt-5">
    <div class="col-md-6 mx-auto ">
        <form action="<?= base_url ?>usuario/reestablece" method="POST" class="form-group"
            id="formularioReestablecerContra">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="email">Introduce tu email</label>
                    <input type="email" name="email" class="form-control" required id="emailLogin">
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="password">Introduce tu DNI</label>
                    <input type="text" name="dni" class="form-control" required id="dniUser">
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="password">Introduce tu nueva contraseña</label>
                    <input type="password" name="nuevaPassword" class="form-control" required id="passLogin">
                    <span class="error-message"></span>
                </div>
            </div>

            <div class="text-center mt-4 pb-5">
                <input type="submit" value="Reestablece tu contraseña" class="btn btn-primary boton ">
            </div>
        </form>
        <script src="<?= base_url ?>assets/JS/nuevaPassUser.js"></script>