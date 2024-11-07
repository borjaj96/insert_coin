<?php

class CategoriaProducto{
    private $id;
    private $nombre;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    //GETTER
    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    //SETTER
    
    public function setId($id){
        $this->id = $id;
    }

    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    //Metodopar arecoger todas las categorias de los articulos
    public function getAll(){
        $categorias = $this->db->query("SELECT * FROM categoria_producto");
        return $categorias;
    }
}