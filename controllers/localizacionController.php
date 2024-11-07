<?php

//Controlador localizacion publicacion articulo
class localizacionController{
    public function index(){
        Utils::isAdmin();
        $localizacionArticulo = new Localizacion();
        $localizacionArticulos = $localizacionArticulo->getAll();
        require_once base_url;
    }
}


