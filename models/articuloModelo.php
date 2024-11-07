<?php


class Articulo{
    private $id;
    private $categoria_id;
    private $titulo;
    private $descripcion;
    private $foto;
    private $localizacion_id;
    private $fecha;
    private $autor;
    
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }


    //GETTER
    public function getId(){
        return $this->id;
    }
    
    public function getCategoria_id(){
        return $this->categoria_id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getFoto(){
        return $this->foto;
    }

    public function getLocalizacion_id(){
        return $this->localizacion_id;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getAutor(){
        return $this->autor;
    }

    //SETTER
    public function setId($id){
        $this->id = $id;
    }

    public function setCategoria_id($categoria_id){
        $this->categoria_id = $categoria_id;
    }

    public function setTitulo($titulo){
        $this->titulo = $this->db->real_escape_string($titulo);
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }

    public function setLocalizacion_id($localizacion_id){
        $this->localizacion_id = $localizacion_id;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setAutor($autor){
        $this->autor = $autor;
    }

    //Para sacar todos los articulos
    public function getAll(){
        $articulos = $this->db->query("SELECT a.id, a.titulo, a.fecha, ca.nombre AS nombre_categoria, lo.nombre AS nombre_localizacion, u.nombre AS nombre_autor 
                                        FROM articulos AS a JOIN categoria_articulo AS ca ON a.categoria_id = ca.id JOIN usuarios AS u 
                                        ON a.autor = u.id JOIN localizacion_articulo AS lo ON a.localizacion_id = lo.id ORDER BY a.fecha DESC;");
        return $articulos;
    }

    //Para sacar todos los articulos de una categoria concreta
    public function getAllCategoria(){
        $sql = "SELECT a.id, a.titulo, a.descripcion, a.foto, a.fecha, ca.nombre AS nombre_categoria, lo.nombre AS nombre_localizacion, u.nombre AS nombre_autor 
                FROM articulos AS a JOIN categoria_articulo AS ca ON a.categoria_id = ca.id JOIN usuarios AS u ON a.autor = u.id 
                JOIN localizacion_articulo AS lo ON a.localizacion_id = lo.id WHERE ca.id = {$this->getCategoria_id()} ORDER BY a.fecha DESC;";
        $articulos = $this->db->query($sql);
        return $articulos;
    }

    //Para sacar UN articulo
    public function getOne(){
        $articulo = $this->db->query("SELECT * FROM articulos WHERE id = {$this->getId()}");
        
        return $articulo->fetch_object();
    }

    //Saca los articulos ubicados en noticias
    public function getNoticias($limit){
        $articulos = $this->db->query("SELECT * FROM articulos WHERE localizacion_id = 5 ORDER BY fecha DESC LIMIT $limit;");
        return $articulos;
    }

    //Saca los articulos ubicados en destacados
    public function getDestacados($limit){
        $articulos = $this->db->query("SELECT * FROM articulos WHERE localizacion_id = 4 ORDER BY fecha DESC LIMIT $limit;");
        return $articulos;
    }

    //Saca los articulos ubicados en la noticia principal
    public function getSlider($limit){
        $articulos = $this->db->query("SELECT * FROM articulos WHERE localizacion_id = 1 ORDER BY fecha DESC LIMIT $limit;");
        return $articulos;
    }

    //Para guardar el articulo en BBDD
    public function saveArticulo(){
        $autor = $this->db->real_escape_string($_SESSION['identity']->id);
        $sql = "INSERT INTO articulos VALUES(NULL, {$this->getCategoria_id()}, '{$this->getTitulo()}', '{$this->getDescripcion()}', '{$this->getFoto()}', '{$this->getLocalizacion_id()}', CURDATE(), '$autor');";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    //Metodo ACTUALIZAR producto en BBDD
    public function edit(){
        $sql = "UPDATE articulos SET categoria_id = {$this->getCategoria_id()}, titulo ='{$this->getTitulo()}', descripcion = '{$this->getDescripcion()}'";
        
        //Comprobamos si llega la imagen
        if($this->getFoto() != null){
            $sql.= ", foto ='{$this->getFoto()}'";
        }
        
        $sql.= ", localizacion_id = '{$this->getLocalizacion_id()}' WHERE id={$this->id};";

        $save = $this->db->query($sql);
        
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }


    //Para borrar el articulo seleccionado
    public function delete(){
        $sql = "DELETE FROM articulos WHERE id={$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }

    //Obtener foto del producto para eliminarla de uploads
    public function obtenerFoto($id){
        $sql = "SELECT foto FROM articulos WHERE id={$id}";
        $consulta = $this->db->query($sql)->fetch_object();
        return $consulta;
    }
}