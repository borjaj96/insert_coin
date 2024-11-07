<?php

class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $dni;
    private $telefono;
    private $provincia;
    private $localidad;
    private $direccion;
    private $cp;
    private $tarjeta;
    private $titular_tarjeta;
    private $validez_tarjeta;
    private $cvv;

    private $iv;
    
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    
    //GETTER
    function getId(){
        return $this->id;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getApellidos(){
        return $this->apellidos;
    }

    function getEmail(){
        return $this->email;
    }

    function getPassword(){
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['COST' => 4]);
    }

    function getRol(){
        return $this->rol;
    }

    public function getDni(){
        return $this->dni;
    }
 
    public function getTelefono(){
        return $this->telefono;
    }

    public function getProvincia(){
        return $this->provincia;
    }
 
    public function getLocalidad(){
        return $this->localidad;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getCp(){
        return $this->cp;
    }

    public function getTarjeta(){
        return $this->tarjeta;
    }

    public function getTitular_tarjeta(){
        
        return $this->titular_tarjeta;
    }

    public function getValidez_tarjeta(){
        return password_hash($this->db->real_escape_string($this->validez_tarjeta), PASSWORD_BCRYPT, ['COST' => 4]);
    }

    public function getCvv(){
        return password_hash($this->db->real_escape_string($this->cvv), PASSWORD_BCRYPT, ['COST' => 4]);
    }

    public function getIv() {
        return $this->iv;
    }

   

    //SETTER
    function setId($id){
        $this->id = $id;
    }
    
    //Escapar caracteres especiales de los campos que se introducen en el registro
    function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password){
        $this->password = $password;
    }

    function setRol($rol){
        $this->rol = $rol;
    }

    public function setDni($dni){
        $this->dni = $this->db->real_escape_string($dni);
    }
    public function setTelefono($telefono){
        $this->telefono = $this->db->real_escape_string($telefono);
    }
 
    public function setProvincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    public function setLocalidad($localidad){
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    public function setDireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function setCp($cp){
        $this->cp = $this->db->real_escape_string($cp);
    }

    public function setTarjeta($tarjeta){
        $this->tarjeta = $this->db->real_escape_string($tarjeta);
    }

    public function setTitular_tarjeta($titular_tarjeta){
        $this->titular_tarjeta = $this->db->real_escape_string($titular_tarjeta);
    }

    public function setValidez_tarjeta($validez_tarjeta){
        $this->validez_tarjeta = $this->db->real_escape_string($validez_tarjeta);
    }

    public function setCvv($cvv){
        $this->cvv = $this->db->real_escape_string($cvv);
    }

    public function setIv($iv){
        $this->iv = $this->db->real_escape_string($iv);
    }

    

    

    //Metodo insertar usuario en BBDD
    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', '{$this->getDni()}', null, null, null, null, null, null, null, null, null);";
        $save = $this->db->query($sql);
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }

    //Metodo comprobar si existe el email en bbdd
    public function checkEmailExiste($email){
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $save = $this->db->query($sql);
        
        // Verificar si se encontraron registros
        if ($save->num_rows > 0) {
            // El correo electrónico ya está registrado
            return true;
        } else {
            // El correo electrónico no existe en la base de datos
            return false;
        }
    }

    //Metodo comprobar si existe el dni en bbdd
    public function checkDniExiste($dni){
        $sql = "SELECT * FROM usuarios WHERE dni = '$dni'";
        $save = $this->db->query($sql);
        
        // Verificar si se encontraron registros
        if ($save->num_rows > 0) {
            // El correo dni ya existe
            return true;
        } else {
            // El dni no existe en la base de datos
            return false;
        }
    }

    //Metodo guardar datos personales
    public function saveDatos(){
        $id = $_SESSION['identity']->id;
        
        $sql = "UPDATE usuarios SET telefono = {$this->getTelefono()}, provincia = '{$this->getProvincia()}', localidad = '{$this->getLocalidad()}', direccion = '{$this->getDireccion()}', cp = {$this->getCp()} WHERE id = $id";

        $save = $this->db->query($sql);
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }

    //Metodo guardar datos de pago
    public function saveDatosPago(){
        $id = $_SESSION['identity']->id;
        $tarjetaCifrada = $this->getTarjeta(); // Obtener la tarjeta cifrada
    
        $sql = "UPDATE usuarios SET tarjeta = '$tarjetaCifrada', titular_tarjeta = '{$this->getTitular_tarjeta()}', validez_tarjeta = '{$this->getValidez_tarjeta()}', cvv = '{$this->getCvv()}' WHERE id = $id";
    
        $save = $this->db->query($sql);
        $result = false;
        
        if ($save) {
            $result = true;
        } else {
            echo "Error al guardar los datos de pago: " . $this->db->error;
            $result = false;
        }
        return $result;
    }
    
    //Metodo insertar admin en BBDD
    public function saveAdmin(){
        $fotoAdmin = 'assets/img/adminLogo.png';
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'admin', null, null, null, null, null, null, null, null, null, null);";
        $save = $this->db->query($sql);
        $result = false;

        if($save){
            $result = true;
        }
        return $result;
    }

    //Metodo acceso
    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;
        
        //Comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();

            //Verificar la contraseña
            $verify = password_verify($password, $usuario->password);
            
            if($verify){
                $result = $usuario;
            }
        }
        return $result;
    }

    //Metodo reestablecer contraseña user
    public function updatePass($email, $dni, $nuevaPassword){
        $email = $this->db->real_escape_string($email);
        $dni = $this->db->real_escape_string($dni);
        $nuevaPassword = $this->db->real_escape_string($nuevaPassword);

        $hashedPassword = password_hash($nuevaPassword, PASSWORD_BCRYPT, ['COST' => 4]);

        $sql = "UPDATE usuarios SET password = '$hashedPassword' WHERE email = '$email' AND dni = '$dni'";
        $update = $this->db->query($sql);

        $result = false;
        if($update){
            $result = true;
        }
        return $result;
    }

    //Metodo cambiar contraseña administrador
    public function cambiarPassUser($id, $nuevaPass){
        $id = intval($id);
        $nuevaPass = $this->db->real_escape_string($nuevaPass);

        $hashedPassword = password_hash($nuevaPass, PASSWORD_BCRYPT, ['cost' => 12]);
        $sql = "UPDATE usuarios SET password = '$hashedPassword' WHERE id = {$this->id}";
        $update = $this->db->query($sql);

        return $update;
    }

    //Para sacar todos los usuarios
    public function getAll(){
        $usuario = $this->db->query("SELECT * FROM usuarios ORDER BY rol ASC");
       
        return $usuario;
    }

    //Para sacar UN usuario
    public function getOne(){
        $id=$_SESSION['identity']->id;
        $usuario = $this->db->query("SELECT * FROM usuarios WHERE id = $id");
       
        return $usuario->fetch_object();
    }

    //Para sacar los datos de pago del usuario
    public function getDatosPago(){
        $id=$_SESSION['identity']->id;
        $datosPago = $this->db->query("SELECT tarjeta, titular_tarjeta, validez_tarjeta, cvv FROM usuarios WHERE id = $id");
       
        return $datosPago->fetch_object();
    }

    //Borra el usuario selecionado
    public function delete(){
        $sql = "DELETE FROM usuarios WHERE id={$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }

    //Obtener foto del producto para eliminarla de uploads
    public function obtenerFoto($id){
        $sql = "SELECT imagen FROM usuarios WHERE id={$id}";
        $consulta = $this->db->query($sql)->fetch_object();
        return $consulta;
    }
}