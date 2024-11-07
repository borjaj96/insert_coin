<h1 class="text-center pt-5">Gestión de artículos</h1>

<div class="botonCrearArt">
    <a href="<?=base_url?>articulo/crearArticulo" class="btn btn-primary ">
        Crear artículo
    </a>
</div>

<?php Utils::deleteSession('articulo');?>
<div class="table-responsive">
    <table class="table table-hover table-responsive">
        <thead>
            <tr>
                <th>ID</th>
                <th>TÍTULO</th>
                <th>CATEGORÍA</th>
                <th>AUTOR</th>
                <th>UBICACION</th>
                <th>FECHA</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $numFilas = $articulos->num_rows; // Obtener el número total de filas
                $filasPorPagina = 10;
                $numPaginas = ceil($numFilas / $filasPorPagina); // Calcular el número total de páginas
                
                $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Obtener la página actual, por defecto la primera página

                $urlPagina = base_url.'articulo/gestion&' . http_build_query(array('pagina' => $paginaActual)); //Genera la URL de la pagina
                
                $inicio = ($paginaActual - 1) * $filasPorPagina; // Calcular el inicio de las filas a mostrar
                $fin = $inicio + $filasPorPagina; // Calcular el fin de las filas a mostrar
            
                $articulos->data_seek($inicio); // Mover el puntero del resultado al inicio de la página actual
                
                $contador = 0; // Contador para limitar el número de filas por página
                
                while (($art = $articulos->fetch_object()) && ($contador < $filasPorPagina)):
            ?>
                <tr>
                    <td><?= $art->id; ?></td>
                    <td><?= $art->titulo; ?></td>
                    <td><?= $art->nombre_categoria; ?></td>
                    <td><?= $art->nombre_autor; ?></td>
                    <td><?= $art->nombre_localizacion; ?></td>
                    <td><?= $art->fecha; ?></td>
                    <td>
                        <a href="<?=base_url?>articulo/ver&id=<?=$art->id?>"><i class="bi bi-eye-fill"></i></a>
                    </td>
                    <td>
                        <a href="<?=base_url?>articulo/editar&id=<?=$art->id?>"><i class="bi bi-pencil-square"></i></a>
                    </td>
                    <td>
                        <a onclick="confirmDelete(event)" href="<?=base_url?>articulo/eliminar&id=<?=$art->id?>"><i class="bi bi-trash"></i></a>
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
<script src="<?= base_url ?>assets/JS/gestionArticulo.js"></script>