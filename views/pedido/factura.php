<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete' || isset($_SESSION['identity'])):?>
<div id="app" class="col-11">
    <?php if(isset($pedido)): ?>

    <img src="<?= base_url ?>assets/img/insert.png" alt="" class="logoFooter">
    <h2>Factura</h2>
    <table>
        <tr>
            <td>
                <p><strong>Número de pedido: </strong><?=$pedido->id?></p>
                <p><strong>Destinatario: </strong><?= $usuario->titular_tarjeta ?></p>
                <p><strong>E-mail: </strong><?= $usuario->email ?></p>
                <p><strong>Dirección: </strong><?= $usuario->direccion ?></p>
            </td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
                <p><strong>DNI: </strong><?= $usuario->dni ?></p>
                <p><strong>CP: </strong><?= $usuario->cp ?></p>
                <p><strong>Localidad: </strong><?= $usuario->localidad ?></p>
                <p><strong>Provincia: </strong><?= $usuario->provincia ?></p>
            </td>
        </tr>
    </table>
    <hr />
    <div class="row my-5">
        <table class="tablaFactura">
            <thead>

                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Producto</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <?php while($producto = $productos->fetch_object()): ?>
            <tbody>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <td><?= $producto->nombre ?></td>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <td><?= $producto->precio ?>€</td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>&nbsp;</th>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Total a pagar:</th>
                    <th><?=$pedido->coste?>€</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php endif;?>
<?php endif;?>