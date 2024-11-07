<?php
require_once 'models/categoriaProductoModelo.php';

//Controlador categoria de producto
class categoriaProductoController{
    public function index(){
        $categoria = new CategoriaProducto();
        $categorias = $categoria->getAll();
        require_once 'views/categoria/index.php';
    }
}