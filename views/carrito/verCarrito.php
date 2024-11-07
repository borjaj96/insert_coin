<h1 class="text-center">CARRITO</h1>

<?php if (isset($productosCarrito) && !empty($productosCarrito)): ?>
    <div class="botonCrearArt">
        <a href="<?=base_url?>carrito/deleteCarrito" class="btn btn-danger ">
            Vaciar carrito
        </a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:50%">Producto</th>
                                <th style="width:10%"></th>
                                <th style="width:30%" class="text-center">Precio</th>
                                <th style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productosCarrito as $item): ?>
                                <tr>
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-2 hidden-xs">
                                                <?php if ($item['producto']->foto != null): ?>
                                                    <img src="<?= base_url ?>assets/user_uploads/images/<?= $item['producto']->foto ?>" alt="" class="">
                                                <?php else: ?>
                                                    <img src="<?= base_url ?>assets/img/noFoto.png" alt="" class="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-sm-10">
                                                <h4 class="nomargin"><?= $item['producto']->nombre ?></h4>
                                                <p><?= $item['producto']->descripcion ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td data-th="precio" class="text-center"><?= $item['precio'] ?>€</td>
                                    <td>
                                        <a href="<?=base_url?>carrito/remove&index=<?=$item['producto']->id?>" class="quitarProducto">
                                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                        </a>  
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><a href="<?= base_url ?>producto/index" class="btn btn-warning">Sigue comprando</a></td>
                                <td></td>
                                <td class="hidden-xs text-center"><strong>Total: <?= $this->calcularTotalCarrito() ?>€</strong></td>
                                <td><a href="<?=base_url?>pedido/hacerPedido" class="btn btn-success btn-block">Pagar <i class="fa fa-angle-right"></i></a></td>
                            </tr>
                        </tfoot>    
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>
    <h3 class="text-center">No hay productos en el carrito.</h3>
    <div class="text-center">
        <a href="<?= base_url ?>producto/index" class="btn btn-warning mt-5">Sigue comprando</a>
    </div>
<?php endif; ?>
<script src="<?= base_url ?>assets/JS/carrito.js"></script>