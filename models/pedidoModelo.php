<?php

class Pedido{
    private $id;
    private $comprador_id;
    private $coste;
    private $estado;
    private $fecha;

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    //GETTER
    function getId(){
        return $this->id;
    }

    function getComprador_id(){
        return $this->comprador_id;
    }

    function getCoste(){
        return $this->coste;
    }

    function getEstado(){
        return $this->estado;
    }

    function getFecha(){
        return $this->fecha;
    }


    //SETTER
    function setId($id){
        $this->id = $id;
    }

    function setComprador_id($comprador_id){
        $this->comprador_id = $comprador_id;
    }

    function setCoste($coste){
        $this->coste = $coste;
    }

    function setEstado($estado){
        $this->estado = $estado;
    }

    function setFecha($fecha){
        $this->fecha = $fecha;
    }

    //Metodo recoger todos los pedidos
    public function getAll(){
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY fecha DESC");
        return $pedidos;
    }

    //Metodo que recoge un pedido
    public function getOne(){
        $pedido = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
        return $pedido->fetch_object();
    }

    //Recoge un pedido de un usuario
    public function getOneByUser(){
        $sql = "SELECT p.id, p.coste FROM pedidos p 
                WHERE p.comprador_id = {$this->getComprador_id()} ORDER BY id DESC LIMIT 1";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    //Recoge todos los pedidos de un usuario
    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p 
                WHERE p.comprador_id = {$this->getComprador_id()} ORDER BY id DESC";
        $pedido = $this->db->query($sql);
        return $pedido;
    }

    //Recoge todos los productos de un pedido
    public function getProductosByPedido($id){
        $sql = "SELECT * FROM productos WHERE id IN (SELECT producto_id FROM linea_pedidos WHERE pedido_id = {$id})";
        $productos = $this->db->query($sql);
        return $productos;
    }

    //Inserta en bbdd el pedido
    public function save(){
        $sql = "INSERT INTO pedidos VALUES(null, {$this->getComprador_id()}, {$this->getCoste()}, 'confirm', CURDATE())";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    //Guarda el pedido en la tabla lineaPedido
    public function saveLinea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido'";;
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach($_SESSION['carrito'] as $elemento){
            $producto = $elemento['producto'];
            echo "id del producto".var_dump($producto->id);

            $insert = "INSERT INTO linea_pedidos (id, pedido_id, producto_id) VALUES (null, {$pedido_id}, {$producto->id});";

            $save = $this->db->query($insert);

            $consulta = "UPDATE productos SET estado = 'vendido' WHERE id = {$producto->id}";
            $update = $this->db->query($consulta);

            $result = false;
        }
        if($save){
            $result = true;
        }
        return $result;
    }

    //Comprueba que la arjeta sea valida
    public function compruebaTarjeta($validezTarjetaIngresada, $cvvIngresado){
        $id = $_SESSION['identity']->id;
        $sql = "SELECT validez_tarjeta, cvv FROM usuarios WHERE id = $id";
        $result = $this->db->query($sql);
    
        if ($result) {
            $row = $result->fetch_assoc();
    
            // Obtener los valores almacenados en la base de datos
            $validezTarjetaDB = $row['validez_tarjeta'];
            $cvvDB = $row['cvv'];
    
            // Comparar los valores ingresados con los almacenados en la base de datos
            if (password_verify($validezTarjetaIngresada, $validezTarjetaDB) && password_verify($cvvIngresado, $cvvDB)) {
                return true; // Validez y CVV coinciden
            }
        }
        return false; // Validez y CVV no coinciden o error en la consulta
    }
}