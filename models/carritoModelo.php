<?php

class Carrito{
    private $id;
    private $usuario_id;
    private $producto_id;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    //GETTER
    function getId(){
        return $this->id;
    }

    function getUsuario_id(){
        return $this->usuario_id;
    }

    function getProducto_id(){
        return $this->producto_id;
    }

    //SETTER
    function setId($id){
        $this->id = $id;
    }

    function setUsuario_id($usuario_id){
        $this->usuario_id = $usuario_id;
    }

    function setProducto_id($producto_id){
        $this->producto_id = $producto_id;
    }

    //Guardar producto en el carrito
    public function save(){
        $usuario = $this->db->real_escape_string($_SESSION['identity']->id);
        $producto = $this->db->real_escape_string($_GET['id']);
        $sql = "INSERT INTO carrito VALUES(null, $usuario, $producto)";
        $save = $this->db->query($sql);
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }

    //Obtener carrito
    public function getAll(){
        $usuario = $this->db->real_escape_string($_SESSION['identity']->id);
        $sql = "SELECT c.id, c.usuario_id, c.producto_id, p.nombre, p.precio
                FROM carrito c
                JOIN productos p ON c.producto_id = p.id;
                ";
        $result = $this->db->query($sql);

        $carrito = array();
        while($row = $result->fetch_assoc()){
            $carrito[] = $row;
        }
        return $carrito;
    }
}