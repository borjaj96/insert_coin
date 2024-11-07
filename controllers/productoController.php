<?php
require_once 'models/productoModelo.php';

class productoController{
    //Carga del index del mercadillo
    public function index(){
        $producto = new Producto();
        $productos = $producto->getProductosVenta();

        //Renderizar vista
        require_once 'views/producto/mercadillo.php';
    }

    //Gestion del mercadillo para los usuarios
    public function gestion(){
        $producto = new Producto;
        $productos = $producto->getAll();

        require_once 'views/producto/gestionProductos.php';
    }

    //Vista productos a la venta
    public function enVenta(){
        $producto = new Producto;
        $productos = $producto->getVenta();

        require_once 'views/producto/enVenta.php';
    }

    //Vista productos vendidos
    public function vendido(){
        $producto = new Producto;
        $productos = $producto->getVendido();

        require_once 'views/producto/vendido.php';
    }
  
    //Gestion del mercadillo para los administradores
    public function gestionAdmin(){
        Utils::isAdmin();
        $producto = new Producto();
        $producto = $producto->getProductos();
        require_once 'views/producto/gestionProductosAdmin.php';
    }

    //Carga de la vista crear producto
    public function crear(){
        require_once 'views/producto/crearProducto.php';
    }

    //Crear y subir producto
    public function save(){
        if(isset($_POST)){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;

            if($nombre && $categoria && $descripcion && $precio){
                $producto = new Producto;
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setcategoria_id($categoria);
                $producto->setPrecio($precio);

                if(isset($_FILES['foto'])){
                    //Guardar la imagen
                    $file = $_FILES['foto'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" ||$mimetype == "image/gif"){
                        if(!is_dir('assets/user_uploads/images')){
                            mkdir('assets/user_uploads/images', 0777, true);
                        }
                        $producto->setFoto($filename);
                        move_uploaded_file($file['tmp_name'], 'assets/user_uploads/images/'.$filename); 
                    }
                    $_SESSION['crear_result'] = 0;
                }
                
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                    $_SESSION['crear_result'] = 1;
                }else{
                    $save = $producto->save();
                    $_SESSION['crear_result'] = 1;
                }

            
                if($save){
                    $_SESSION['producto'] = 'complete';
                    $_SESSION['crear_result'] = 1;
                }else{
                    $_SESSION['producto'] = 'failed';
                    $_SESSION['crear_result'] = 0;
                }
            }else{
                $_SESSION['producto'] = 'failed';
                $_SESSION['crear_result'] = 0;
            }
        }else{
            $_SESSION['producto'] = 'failed';
            $_SESSION['crear_result'] = 0;
        }
        header("Location:".base_url.'producto/gestion?errorCrearProducto='.($_SESSION['crear_result'] ? '0': '1'));
    }

    //Editar producto 
    public function editar(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto;
            $producto->setId($id);
            $prod = $producto->getOne();

            require_once 'views/producto/crearProducto.php';
        }else{
            header("Location:".base_url.'producto/gestion');
        }
    }

    //Eliminar producto completo
    public function eliminar(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $delete = $producto->delete();

            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }

        if(isset($_SESSION['admin'])){
            header("Location:".base_url.'producto/gestionAdmin');
        }else{
            header("Location:".base_url.'producto/gestion');
        }
        
    }

    //Ver pagina de producto concreto
    public function ver(){

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $producto = new Producto;
            $producto->setId($id);
            $prod = $producto->getOne();

            require_once 'views/producto/verProducto.php';
        }
    }

    //Filtro de busqueda mercadillo 
    public function filtrarPorCategoria() {
        // Obtener el ID de categoría seleccionado
        $categoria_id = $_POST['categoria'];
        
        // Obtener todos los productos o filtrar por categoría
        if ($categoria_id) {
            $producto = new Producto();
            $producto->setCategoria_id($categoria_id);
            $productos = $producto->filtrarPorCategoria();
        } else {
            $producto = new Producto();
            $productos = $producto->getProductosVenta();
        }
    
        // Renderizar vista con los productos filtrados
        require_once 'views/producto/mercadillo.php';
    }
}