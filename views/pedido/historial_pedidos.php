<h1 class="text-center">Historial de pedidos</h1>
<a href="<?=base_url?>usuario/miPerfil" class="flechaAtras "><i class="bi bi-arrow-left"></i></a>
<table class="table table-hover mt-5">
    <thead>
        <tr class="text-center">
            <th>ID PEDIDO</th>
            <th>FECHA</th>
            <th>PRECIO</th>
            
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php while($ped = $pedidos->fetch_object()): ?>
            <tr class="text-center">
                <td><?= $ped->id; ?></td>
                <td><?= $ped->fecha; ?></td>
                <td><?= $ped->coste; ?>€</td>
                <td>
                    <a href="<?=base_url?>pedido/detalle&id=<?=$ped->id?>"><i class="bi bi-eye-fill"></i></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>