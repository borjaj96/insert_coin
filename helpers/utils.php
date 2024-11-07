<?php

class Utils{
    //Funcion que elimina la sesion
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }
    //Funcion que comprueba si el usuario es administrador
    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    //Funcion que comprueba si el usuario es usuario base no administrador
    public static function isUser(){
        if(!isset($_SESSION['identity'])){
            header("Location:".base_url);
        }else{
            return true;
        }
    }

    //Funcion que muestra todas las categorias de articulos
    public static function showCategorias(){
        require_once 'models/categoriaArticuloModelo.php';
        $categoria = new CategoriaArticulo();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    //Funcion que muestra todas las categorias de producto
    public static function showCategoriasProducto(){
        require_once 'models/categoriaProductoModelo.php';
        $categoria = new CategoriaProducto();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    //Funcion que muestra todas las localizaciones para los articulso
    public static function showLocalizacion(){
        require_once 'models/localizacionModelo.php';
        $localizacion = new Localizacion();
        $localizaciones = $localizacion->getAll();
        return $localizaciones;
    }

    //Funcion que recoge los datos del carrito
    public static function infoCarrito() {
        $info = array(
            'count' => 0,
            'total' => 0
        );
    
        if (isset($_SESSION['carrito']) && is_array($_SESSION['carrito'])) {
            $info['count'] = count($_SESSION['carrito']);
    
            foreach ($_SESSION['carrito'] as $producto) {
                $info['total'] += $producto['precio'];
            }
        }
        return $info;
    }
    
    //Funcion que calcula el precio total del carrito
    public static function totalCarrito() {
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

