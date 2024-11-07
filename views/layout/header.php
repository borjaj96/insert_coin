<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT COIN!</title>
    <link rel="icon" href="<?= base_url ?>assets/img/soloLogo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Script de la api -->
    <script src="<?= base_url ?>assets/JS/rawg-api.js"></script>
   
    <script src="<?= base_url ?>assets/JS/regExp.js"></script>
    <script src="<?= base_url ?>assets/JS/validaciones.js"></script>
</head>

<body> 
    <!-- HEADER -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand <?php if (empty($_GET['controller']) && empty($_GET['action'])) ; ?>" href="<?= base_url ?>"><img src="<?= base_url ?>assets/img/insert.png" alt="" class="logoHeader"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Llamada al metodo de utils para sacar las categorias de BBDD -->
                <?php $categorias = Utils::showCategorias();?>

                <div class="collapse navbar-collapse barraNavegacion" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php if (empty($_GET['controller']) && empty($_GET['action'])) echo 'active'; ?>" href="<?= base_url ?>">INICIO</a>
                        </li>

                        <!-- Bucle para sacar y mostrar las categorías -->
                        <?php while ($cat = $categorias->fetch_object()): ?>
                            <li class="nav-item">
                            <a class="nav-link <?php if (isset($_GET['controller']) && $_GET['controller'] == 'categoriaArticulo' && $_GET['action'] == 'ver' && $_GET['id'] == $cat->id) echo 'active'; ?>" href="<?= base_url ?>categoriaArticulo/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a>

                            </li>
                        <?php endwhile; ?>

                        <li class="nav-item">
                            <a class="nav-link <?php if ((isset($_GET['controller']) && $_GET['controller'] == 'producto') && (!isset($_GET['action']) || $_GET['action'] == 'index')) echo 'active'; ?>" href="<?= base_url ?>producto/index">MERCADILLO</a>

                        </li>
                    </ul>
        
                    <!-- Creamos la variable para la info del carrito -->
                    <?php $info = Utils::infoCarrito();?>

                    <!-- Si no hay sesion muestra el menu de opciones de acceso -->
                    <?php if(!isset($_SESSION['identity'])): ?>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-fill login"></i>
                                </a>
                                    
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li><a class="dropdown-item" href="<?=base_url?>usuario/acceso">Iniciar sesión</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?=base_url?>usuario/registro">Crear cuenta</a></li>
                                </ul>   
                            </li>
                        </ul>
                    <?php endif; ?>

                    <!-- Si la sesion es admin muestra esto -->
                    <?php  if(isset($_SESSION['admin']) && Utils::isAdmin()): ?>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-tools login hola"><h7> Hola, <?= $_SESSION['identity']->nombre ?></h7></i>  
                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="<?=base_url?>articulo/gestion">Gestión de artículos</a></li>
                                        <li><a class="dropdown-item" href="<?=base_url?>producto/gestionAdmin">Gestión de mercadillo</a></li>
                                        <li><a class="dropdown-item" href="<?=base_url?>usuario/gestion">Gestión de usuarios</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="<?=base_url?>usuario/logout" id="cerrarSesion">Cerrar sesión</a></li>
                                    </ul>
                                </a>
                            </li>
                        </ul>
                            
                    <!-- Si la sesion no es admin muestra esto -->
                    <?php elseif(isset($_SESSION['identity'])): ?>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-fill login"><h7> Hola, <?= $_SESSION['identity']->nombre ?></h7></i>
                                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDarkDropdownMenuLink">
                                        <li><a class="dropdown-item" href="<?=base_url?>carrito/index">Carrito <i class="bi bi-cart4"></i></a></li>
                                        <li><a class="dropdown-item" href="<?=base_url?>usuario/miPerfil">Mi perfil</a></li>
                                        <li><a class="dropdown-item" href="<?=base_url?>producto/gestion">Mis anuncios</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="<?=base_url?>usuario/logout" id="cerrarSesion">Cerrar sesión</a></li>     
                                    </ul>
                                </a>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
 
    <!-- MAIN -->
    <main>
        <div class="container containerPrincipal bg-light mt-5 p-4">
    