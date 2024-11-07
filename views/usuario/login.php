<h1 class="text-center pt-5">Inicia sesión</h1>
<div class="text-center">
    <i class="bi bi-person-fill login"></i>
</div>


<div class="row form-container">
    <div class="col-md-6 mx-auto ">
        <form action="<?= base_url ?>usuario/login" method="POST" class="form-group" id="formularioLogin">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" required id="emailLogin">
                    <span class="error-message"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control" required id="passLogin">
                    <span class="error-message"></span>
                </div>
            </div>

            <div class="text-center mt-4 pb-5">
                <input type="submit" value="Inicia sesión" class="btn btn-primary boton" id="iniciarSesion">
            </div>


        </form>

    </div>
    <div class="text-center">
        <a href="<?=base_url?>usuario/reestablecerPass" class="contraOlvidada">He olvidado mi contraseña</a>
    </div>
</div>
<script src="<?= base_url ?>assets/JS/login.js"></script>