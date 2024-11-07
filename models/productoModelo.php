<?php

class Producto{
    private $id;
    private $categoria_id;
    private $vendedor_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $fecha;
    private $foto;

    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    //GETTER
    function getId(){
        return $this->id;
    }

    function getcategoria_id(){
        return $this->categoria_id;
    }

    function getVendedor_id(){
        return $this->vendedor_id;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getDescripcion(){
        return $this->descripcion;
    }

    function getPrecio(){
        return $this->precio;
    }

    function getFecha(){
        return $this->fecha;
    }

    function getFoto(){
        return $this->foto;
    }


    //SETTER
    function setId($id){
        $this->id = $id;
    }

    function setcategoria_id($categoria_id){
        $this->categoria_id = $categoria_id;
    }

    function setVendedor_id($vendedor_id){
        $this->vendedor_id = $vendedor_id;
    }

    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setPrecio($precio){
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setFecha($fecha){
        $this->fecha = $fecha;
    }

    function setFoto($foto){
        $this->foto = $foto;
    }

    //Metodo que recoge todos los productos del vendedor
    public function getAll(){
        $vendedor = $this->db->real_escape_string($_SESSION['identity']->id);
        $productos = $this->db->query("SELECT p.*, c.nombre AS nombre_categoria
                    FROM productos p
                    JOIN categoria_producto c ON p.categoria_id = c.id
                    WHERE p.vendedor_id = $vendedor
                    ORDER BY p.fecha DESC");
        return $productos;
    }

    //Metodo que recoge los producto a la venta
    public function getVenta(){
        $vendedor = $this->db->real_escape_string($_SESSION['identity']->id);
        $productos = $this->db->query("SELECT p.*, c.nombre AS nombre_categoria
                    FROM productos p
                    JOIN categoria_producto c ON p.categoria_id = c.id
                    WHERE p.vendedor_id = $vendedor AND estado = 'disponible'
                    ORDER BY p.fecha DESC");
        return $productos;
    }

    //Metodo que recoge los productos vendidos de cada usuario
    public function getVendido(){
        $vendedor = $this->db->real_escape_string($_SESSION['identity']->id);
        $productos = $this->db->query("SELECT p.*, c.nombre AS nombre_categoria
                    FROM productos p
                    JOIN categoria_producto c ON p.categoria_id = c.id
                    WHERE p.vendedor_id = $vendedor AND estado = 'vendido'
                    ORDER BY p.fecha DESC");
        return $productos;
    }

    //Recoge un producto
    public function getOne(){
        //$vendedor = $this->db->real_escape_string($_SESSION['identity']->id);
        $producto = $this->db->query("SELECT p.*, c.nombre AS nombre_categoria
                    FROM productos p
                    JOIN categoria_producto c ON p.categoria_id = c.id
                    WHERE p.id = {$this->getId()}
                    ORDER BY p.fecha DESC");
        return $producto->fetch_object();
    }

    //Recoge todos los productos
    public function getProductos(){
        $productos = $this->db->query("SELECT p.*, u.nombre AS nombre_vendedor, u.id AS id_vendedor, cp.nombre AS categoria_producto
                                        FROM productos p
                                        INNER JOIN usuarios u ON p.vendedor_id = u.id
                                        INNER JOIN categoria_producto cp ON p.categoria_id = cp.id;
                                        ");
        return $productos;
    }

    //Recoge los producto sque estan a la venta
    public function getProductosVenta(){
        $productos = $this->db->query("SELECT p.*, u.nombre AS nombre_vendedor, u.id AS id_vendedor, cp.nombre AS categoria_producto
                                        FROM productos p
                                        INNER JOIN usuarios u ON p.vendedor_id = u.id
                                        INNER JOIN categoria_producto cp ON p.categoria_id = cp.id
                                        WHERE estado = 'disponible';
                                        ");
        return $productos;
    }

    //Filtra los productos por categoria
    public function filtrarPorCategoria(){
        $categoria_id = $this->getcategoria_id();
        $sql = "SELECT p.*, u.nombre AS nombre_vendedor, u.id AS id_vendedor, cp.nombre AS categoria_producto
        FROM productos p
        INNER JOIN usuarios u ON p.vendedor_id = u.id
        INNER JOIN categoria_producto cp ON p.categoria_id = cp.id
        WHERE estado = 'disponible'";

        if ($categoria_id) {
            $sql .= " AND categoria_id = {$categoria_id}";
        }
        $sql .= ";";

        
        $productos = $this->db->query($sql);
        return $productos;
    }

    //Sube un producto
    public function save(){
        $vendedor = $this->db->real_escape_string($_SESSION['identity']->id);
        $sql = "INSERT INTO productos VALUES(null, {$this->getCategoria_id()}, $vendedor, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, CURDATE(), '{$this->getFoto()}', 'disponible')";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    //Edita un producto ya subido
    public function edit(){
        $vendedor = $this->db->real_escape_string($_SESSION['identity']->id);
        $sql = "UPDATE productos SET categoria_id={$this->getCategoria_id()}, nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()} ";
        if($this->getFoto() != null){
            $sql .= ", foto='{$this->getFoto()}'";
        }
        $sql .= " WHERE id={$this->id}";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    //Borra un producto
    public function delete(){
        $sql = "DELETE FROM productos WHERE id={$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }
}