<?php

class CategoriaArticulo{
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


    //Metodo listar categorias
    public function getAll(){
        $categorias = $this->db->query("SELECT * FROM categoria_articulo;");
        return $categorias;
    }

    //Metodo listar UNA categoria
    public function getOne(){
        $categoria = $this->db->query("SELECT * FROM categoria_articulo WHERE id = {$this->getId()}");
        return $categoria->fetch_object();
    }

    //Metodo insertar categoria en BBDD
    public function save(){
        $sql = "INSERT INTO categoria_articulo VALUES(NULL, '{$this->getNombre()}');";
        $save = $this->db->query($sql);
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }
} 