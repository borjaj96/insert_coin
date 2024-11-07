<!-- DATOS PERSONALES -->
<h2 class="text-center pt-5">Información de pago</h2>
<a href="<?=base_url?>usuario/miPerfil" class="flechaAtras "><i class="bi bi-arrow-left"></i></a>

<div class="row form-container mt'4">
    <div class="col-md-12 mx-auto">
        <form action="<?=base_url?>usuario/savePago" method="POST" class="form-group" id="formularioDatosPago">
            <div class="row d-flex">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="titular">Titular de la tarjeta</label>
                        <input type="text" name="titular" class="form-control" required
                            value="<?= $usuario->titular_tarjeta?>" id="titularTarjeta">
                        <span class="error-message"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tarjeta">Número de tarjeta</label>
                        <input type="text" name="tarjeta" class="form-control" required value="<?= $usuario->tarjeta?>"
                            id="numeroTarjeta">
                        <span class="error-message"></span>
                    </div>
                </div>
            </div>

            <div class="row d-flex">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="validezTarjeta">Validez</label>
                        <input type="month" name="validezTarjeta" class="form-control"
                            value="<?= $usuario->validez_tarjeta?>" id="validezTarjeta">
                        <span class="error-message"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="password" name="cvv" class="form-control" required id="cvvTarjeta">
                        <span class="error-message"></span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 pb-5">
                <input type="submit" value="Actualizar datos de pago" class="btn btn-primary boton">
            </div>
        </form>
    </div>
</div>
<script src="<?= base_url ?>assets/JS/datos_usuario.js"></script>