<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'):?>
    <h1 class="text-center">Tu pedido ha sido confirmado</h1>
    <div class="pedido">
        <?php if(isset($pedido)): ?>
            <h3 class="mt-5 mb-5">Datos del pedido</h3>

            <div class="d-flex flex-column flex-md-row flex-wrap">
                <div style="margin-right: 40px;">
                    <p><strong>Número de pedido: </strong><?=$pedido->id?></p>
                    <p><strong>Destinatario: </strong><?= $usuario->titular_tarjeta ?></p>
                    <p><strong>E-mail: </strong><?= $usuario->email ?></p>
                    <p><strong>Dirección: </strong><?= $usuario->direccion ?></p>
                </div>
                <div>
                    <p><strong>DNI: </strong><?= $usuario->dni ?></p>
                    <p><strong>CP: </strong><?= $usuario->cp ?></p>
                    <p><strong>Localidad: </strong><?= $usuario->localidad ?></p>
                    <p><strong>Provincia: </strong><?= $usuario->provincia ?></p>
                </div>
            </div>


            <table id="cart" class="table table-hover table-condensed border">
                <thead>
                    <tr>
                        <th style="width:50%">Producto</th>
                        <th style="width:10%">&nbsp;</th>
                        <th style="width:8%" class="text-center">&nbsp;</th>
                        <th style="width:22%" class="text-center">Precio</th>
                        <!-- <th style="width:10%"></th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php while($producto = $productos->fetch_object()): ?>
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-2 hidden-xs">
                                        <img src="<?= base_url ?>assets/user_uploads/images/<?= $producto->foto ?>" alt="" class="">
                                    </div>
                                    <div class="col-sm-10">
                                        <h4 class="nomargin"><?= $producto->nombre ?></h4>
                                        <p><?= $producto->descripcion ?></p>
                                    </div>
                                </div>
                            </td>
                            <td></td>
                            <td data-th="Quantity" class="text-center">&nbsp;</td>
                            <td data-th="precio" class="text-center"><?= $producto->precio ?>€</td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr class="visible-xs">
                        <td class="text-left"><strong>&nbsp;</strong></td>
                    </tr>
                    <tr>
                        <td class="hidden-xs">&nbsp;</td>
                        <td class="hidden-xs">&nbsp;</td>
                        <td class="hidden-xs">&nbsp;</td>
                        <td class="hidden-xs text-center"><strong>Total: <?=$pedido->coste?>€</strong></td>
                    </tr>
                </tfoot>
            </table>
        <?php endif;?>
    </div>

    <div class="text-center">
        <a href="<?=base_url?>pedido/factura" target="_blank" class="btn btn-success mt-5">Descargar factura</a>
    </div>

<?php else:?>
    <h1 class="text-center titulo">Tu pedido no ha podido procesarse</h1>
<?php endif;?>