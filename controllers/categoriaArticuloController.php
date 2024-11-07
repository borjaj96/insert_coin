<?php

require_once 'models/categoriaArticuloModelo.php';
require_once 'models/articuloModelo.php';

class categoriaArticuloController{
    //Index paginas categorias articulos
    public function index(){
        Utils::isAdmin();
        $categoriaArticulo = new CategoriaArticulo();
        $categoriaArticulos = $categoriaArticulo->getAll();
        require_once base_url;
    }

    //Metodo ver la categoria
    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //Conseguir la categoria
            $categoria = new CategoriaArticulo;
            $categoria->setId($id);

            $categoria = $categoria->getOne();

            //Conseguir articulos
            $articulo = new Articulo;
            $articulo->setCategoria_id($id);
            $articulos = $articulo->getAllCategoria();

        }

        require_once 'views/articulo/verCategoriaArticulo.php';
    }
}