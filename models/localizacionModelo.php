<?php
class Localizacion{
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

    //Metodo listar localizaciones
    public function getAll(){
        $localizacion = $this->db->query("SELECT * FROM localizacion_articulo;");
        return $localizacion;
    }

    //Metodo insertar localizaciones en BBDD
    public function save(){
        $sql = "INSERT INTO localizacion_articulo VALUES(NULL, '{$this->getNombre()}');";
        $save = $this->db->query($sql);
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }
}