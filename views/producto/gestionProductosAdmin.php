<h1 class="text-center pt-5">Gestión de productos</h1>

<div class="table-responsive">
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th>ID</th>
                <th>PRODUCTO</th>
                <th>CATEGORÍA</th>
                <th>VENDEDOR</th>
                <th>PRECIO</th>
                <th>ESTADO</th>
                <th>FECHA</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $numFilas = $producto->num_rows; // Obtener el número total de filas
                $filasPorPagina = 10;
                $numPaginas = ceil($numFilas / $filasPorPagina); // Calcular el número total de páginas
                
                $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Obtener la página actual, por defecto la primera página

                $urlPagina = base_url.'articulo/gestion&' . http_build_query(array('pagina' => $paginaActual)); //Genera la URL de la pagina
                
                $inicio = ($paginaActual - 1) * $filasPorPagina; // Calcular el inicio de las filas a mostrar
                
                $producto->data_seek($inicio); // Mover el puntero del resultado al inicio de la página actual
                
                $contador = 0; // Contador para limitar el número de filas por página
                
                while($prod = $producto->fetch_object()): 
            
            ?>
                <tr>
                    <td><?= $prod->id; ?></td>
                    <td><?= $prod->nombre; ?></td>
                    <td><?= $prod->categoria_producto; ?></td>
                    <td><?= $prod->nombre_vendedor; ?></td>
                    <td><?= $prod->precio; ?></td>
                    <td><?= $prod->estado; ?></td>
                    <td><?= $prod->fecha; ?></td>
                    
                    <td>
                        <a href="<?=base_url?>producto/ver&id=<?=$prod->id?>"><i class="bi bi-eye-fill"></i></a>
                    </td>
                    <td>
                        <a onclick="confirmDeleteProducto(event)" href="<?=base_url?>producto/eliminar&id=<?=$prod->id?>"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            <?php 
                $contador++;
                endwhile; 
            ?>
        </tbody>
    </table>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php if ($paginaActual > 1): ?>
            <li class="page-item"><a class="page-link" href="<?= $urlPagina ?>&pagina=<?= $paginaActual - 1; ?>">Previous</a></li>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $numPaginas; $i++): ?>
            <li class="page-item <?php if ($i == $paginaActual) echo 'active'; ?>"><a class="page-link" href="<?= $urlPagina ?>&pagina=<?= $i; ?>"><?= $i; ?></a></li>
        <?php endfor; ?>
        
        <?php if ($paginaActual < $numPaginas): ?>
            <li class="page-item"><a class="page-link" href="<?= $urlPagina ?>&pagina=<?= $paginaActual + 1; ?>">Next</a></li>
        <?php endif; ?>
    </ul>
</nav>
<script src="<?= base_url ?>assets/JS/gestionProductos.js"></script>