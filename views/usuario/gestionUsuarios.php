<h1 class="text-center pt-5">Gestión de usuarios</h1>

<div class="botonCrearArt">
    <a href="<?=base_url?>usuario/crearAdmin" class="btn btn-primary">
        Crear usuario Admin
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>APELLIDOS</th>
                <th>EMAIL</th>
                <th>PASSWORD</th>
                <th>ROL</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $numFilas = $usuarios->num_rows; // Obtener el número total de filas
                $filasPorPagina = 10;
                $numPaginas = ceil($numFilas / $filasPorPagina); // Calcular el número total de páginas
                
                $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1; // Obtener la página actual, por defecto la primera página

                $urlPagina = base_url.'usuario/gestion&' . http_build_query(array('pagina' => $paginaActual)); //Genera la URL de la pagina
                
                $inicio = ($paginaActual - 1) * $filasPorPagina; // Calcular el inicio de las filas a mostrar
                
                $usuarios->data_seek($inicio); // Mover el puntero del resultado al inicio de la página actual
                
                $contador = 0; // Contador para limitar el número de filas por página
                
                while ($contador < $filasPorPagina && $user = $usuarios->fetch_object()):
            ?>
            <tr>
                <td><?= $user->id; ?></td>
                <td><?= $user->nombre; ?></td>
                <td><?= $user->apellidos; ?></td>
                <td><?= $user->email; ?></td>
                <td><?= $user->password; ?></td>
                <td><?= $user->rol; ?></td>
                <td>
                    <a href="<?=base_url?>usuario/reestablecerPassAdmin&id=<?=$user->id?>"><i class="bi bi-pencil-square"></i></a>
                </td>
                <td>
                    <a onclick="confirmDeleteUser(event)" href="<?=base_url?>usuario/eliminar&id=<?=$user->id?>"><i class="bi bi-trash"></i></a>
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
<script src="<?= base_url ?>assets/JS/gestionUsuarios.js"></script>