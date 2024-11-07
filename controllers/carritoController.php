<?php
require_once 'models/productoModelo.php';

class carritoController {
    //Index del carrito
    public function index() {
        if (isset($_SESSION['identity'])) {
            // Verificar si el carrito está vacío o no
            if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                $carrito = $_SESSION['carrito'];
            } else {
                $carrito = array();
            }
            
            // Obtener el ID del usuario logueado
            $usuario_id = $_SESSION['identity']->id;
            
            // Filtrar los productos del carrito asociados al usuario actual
            $productosCarrito = array();
            foreach ($carrito as $item) {
                if ($item['usuario_id'] == $usuario_id) {
                    $productosCarrito[] = $item;
                }
            }
            require_once "views/carrito/verCarrito.php";
        } else {
            header("Location:".base_url."producto/index");
        }
    }

    //Agregar producto al carrito
    public function add() {
        // Verificar si el usuario está logueado
        if (isset($_SESSION['identity'])) {
            // Recoger por URL el id del producto
            if (isset($_GET['id'])) {
                $producto_id = $_GET['id'];
            } else {
                header("Location:".base_url."producto/index"); 
            }
            
            // Verificar si el producto ya existe en el carrito del usuario actual
            $productExists = false;
            if (isset($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $item) {
                    if ($item['id'] == $producto_id && $item['usuario_id'] == $_SESSION['identity']->id) {
                        $productExists = true;
                        break;
                    }
                }
            } 
            
            // Si el producto no existe en el carrito, agregarlo
            if (!$productExists) {
                // Obtener el producto
                $producto = new Producto();
                $producto->setId($producto_id);
                $producto = $producto->getOne();
                
                // Agregar al carrito
                if (is_object($producto)) {
                    $_SESSION['carrito'][$producto->id] = array(
                        "id" => $producto->id,
                        "precio" => $producto->precio,
                        "producto" => $producto,
                        "usuario_id" => $_SESSION['identity']->id
                    );
                    $_SESSION['carrito_result'] = 1;
                }
            } else {
                $_SESSION['carrito_result'] = 0;
                header("Location:".base_url.'producto/index?errorInsertarCarrito='.($_SESSION['carrito_result'] ? '0': '1'));
                exit();
            }
            
            header("Location:".base_url.'carrito/index?errorInsertarCarrito='.($_SESSION['carrito_result'] ? '0': '1'));
        } else {
            // Redirigir al usuario a la página de inicio de sesión si no está logueado
            header("Location:".base_url.'login/index?errorInsertarCarrito='.($_SESSION['carrito_result'] ? '0': '1'));
        }
    }

    //Borrar un producto del carrito
    public function remove(){
        if (isset($_GET['index']) && isset($_SESSION['carrito'])) {
            $index = intval($_GET['index']);
          
            if (isset($index)) {
                unset($_SESSION['carrito'][$index]);
            }
           
            header("Location: " . base_url . "carrito/index");
            exit();
        } else {
            header("Location: " . base_url . "carrito/index");
            exit();
        }
    }

   //Vaciar carrito
    public function deleteCarrito() {
        if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
            $usuario_id = $_SESSION['identity']->id;
            
            foreach ($_SESSION['carrito'] as $key => $item) {
                if ($item['usuario_id'] == $usuario_id) {
                    unset($_SESSION['carrito'][$key]);
                }
            }
        }
        
        header("Location:".base_url."producto/index");
    }
    
    //Informacion del carrito
    public static function infoCarrito() {
        $info = array(
            'count' => 0,
            'total' => 0
        );
    
        if (isset($_SESSION['carrito'])) {
            $info['count'] = count($_SESSION['carrito']);
    
            foreach ($_SESSION['carrito'] as $producto) {
                $info['total'] += $producto['precio'];
            }
        }
    
        return $info;
    }

    //Calcula el precio total del carrito
    private function calcularTotalCarrito() {
        $total = 0;
    
        if (isset($_SESSION['carrito'])) {
            $usuario_id = $_SESSION['identity']->id;
    
            foreach ($_SESSION['carrito'] as $item) {
                if ($item['usuario_id'] == $usuario_id) {
                    $total += $item['precio'];
                }
            }
        }
    
        return $total;
    }
    
    
}




