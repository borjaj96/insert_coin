<?php
require_once 'models/usuarioModelo.php';
require_once 'models/pedidoModelo.php';

class usuarioController{

    //Carga la vista de registro de usuarios
    public function registro(){
        require_once 'views/usuario/crear_usuario.php';
    }

    //Carga la vista del login
    public function acceso(){
        require_once 'views/usuario/login.php';
    }

    //Cierra la sesion iniciada
    public function cerrar_sesion(){
        require_once 'views/usuario/index.php';
    }

    //Carga la vista de restaurar contraseña del usuario
    public function reestablecerPass(){
        require_once 'views/usuario/reestablecerPass.php';
    }

    //Carga la vista de restaurar contraseña del administrador
    public function reestablecerPassAdmin(){
        require_once 'views/usuario/reestablecerPassAdmin.php';
    }


    public function datos_usuario(){
        // Verificar si el usuario está autenticado
        if (isset($_SESSION['identity'])) {
            // Obtener el objeto Usuario de la sesión
            $usuario = new Usuario();
            $usuario->setId($_SESSION['identity']->id);
    
            // Obtener los datos del usuario desde la base de datos
            $usuarioModelo = new Usuario();
            $usuario = $usuarioModelo->getOne($usuario);
    
            // Cargar la vista y pasar los datos del usuario
            require_once 'views/usuario/datos_usuario.php';
        } else {
            // El usuario no está autenticado, redireccionar a la página de inicio de sesión
            header("Location: " . base_url . "usuario/acceso");
        }
    }
 
    //Muestra datos de pago
    public function datos_pago(){
        // Verificar si el usuario está autenticado
        if (isset($_SESSION['identity'])) {
            // Crear una instancia del modelo Usuario
            $usuarioModelo = new Usuario();
            $usuario = $usuarioModelo->getDatosPago($_SESSION['identity']->id);

            require_once 'views/usuario/datos_pago.php';
        } else {
            // El usuario no está autenticado, redireccionar a la página de inicio de sesión
            header("Location: " . base_url . "usuario/acceso");
        }
    }

    //Guardar usuario en bbdd
    public function save(){
        if(isset($_POST)){
            //Comprobamos que los campos que llegan por POST existen
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $dni = isset($_POST['dni']) ? $_POST['dni'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
    
            //Comprobar si alguno de los campos esta en false
            if($nombre && $apellidos && $dni && $email && $password){
                $usuario = new Usuario();
                // Verificar si el correo electrónico ya existe en la base de datos
                $emailExiste = $usuario->checkEmailExiste($email);
    
                if ($emailExiste) {
                    echo '<script>alert("El correo electrónico ya está registrado");</script>';
                    $_SESSION['crear_result'] = 0;
                    header("Location:".base_url.'usuario/registro?errorCrearCuenta='.($_SESSION['crear_result'] ? '0': '1'));
                    die();
                }

                //Verificar si el dni ya esta registrado en bbdd
                $dniExiste = $usuario->checkDniExiste($dni);

                if($dniExiste){
                    $_SESSION['crear_result'] = 0;
                    header("Location:".base_url.'usuario/registro?errorCrearCuenta='.($_SESSION['crear_result'] ? '0': '1'));
                    die();
                }
                
                //Comprobar que nos llegan los datos 
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setDni($dni);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
    
                //Llamada al metodo save del modelo y lo guarda en BBDD
                $save = $usuario->save();
    
                if($save){
                    //Crear sesion complete
                    $_SESSION['crear_result'] = 1;
                    header("Location:".base_url.'usuario/acceso?errorCrearCuenta='.($_SESSION['crear_result'] ? '0': '1'));
                }else{
                    //Crear sesion failed
                   // $_SESSION['crear_result'] = 0;
                }
                //$_SESSION['crear_result'] = 1;
            }
        }else{
            $_SESSION['crear_result'] = 0;
            header("Location:".base_url.'usuario/registro?errorCrearCuenta='.($_SESSION['crear_result'] ? '0': '1'));
        }
    }

    //Guardar datos personales
    public function saveDatos(){
        if(isset($_POST)){
       
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $cp = isset($_POST['cp']) ? $_POST['cp'] : false;

            //Comprobar si alguno de los campos esta en false
            if($telefono && $provincia && $localidad && $direccion && $cp){
                $user = new Usuario();
                
                //Comprobar que nos llegan los datos
                $user->setTelefono($telefono);
                $user->setProvincia($provincia);
                $user->setLocalidad($localidad);
                $user->setDireccion($direccion);
                $user->setCp($cp);

                $save = $user->saveDatos();
                if($save){
                    //Crear sesion complete
                    $_SESSION['datos'] = "complete";
                    $_SESSION['datos_result'] = 1;
                }else{
                    //Crear sesion failed
                    $_SESSION['datos'] = "failed";
                    $_SESSION['datos_result'] = 0;
                }
            }else{
                $_SESSION['datos'] = "failed";
                $_SESSION['datos_result'] = 1;
            }

        }else{
            $_SESSION['datos'] = "failed";
            $_SESSION['datos_result'] = 0;
        }
        //Pase lo que pase nos redirige al registro
        header("Location:".base_url.'usuario/miPerfil?errorActualizarDatos='.($_SESSION['datos_result'] ? '0': '1'));
    }

    //Guardar los datos de pago
    public function savePago(){
        if(isset($_POST)){
            $tarjeta = isset($_POST['tarjeta']) ? $_POST['tarjeta'] : false;
            $titular = isset($_POST['titular']) ? $_POST['titular'] : false;
            $validezTarjeta = isset($_POST['validezTarjeta']) ? $_POST['validezTarjeta'] : false;
            $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : false;          

            if($tarjeta && $titular && $validezTarjeta && $cvv){
                $user = new Usuario();
                $user->setTarjeta($tarjeta);
                $user->setTitular_tarjeta($titular);
                $user->setValidez_tarjeta($validezTarjeta);
                $user->setCvv($cvv);
                

                $save = $user->saveDatosPago();
                if($save){
                    //Crear sesion complete
                    $_SESSION['datos'] = "complete";
                    $_SESSION['datos_result'] = 1;
                }else{
                    //Crear sesion failed
                    $_SESSION['datos'] = "failed";
                    $_SESSION['datos_result'] = 0;
                }
            }else{
                $_SESSION['datos'] = "failed";
                $_SESSION['datos_result'] = 1;
            }
        }else{
            $_SESSION['datos'] = "failed";
            $_SESSION['datos_result'] = 0;
        }
        //Pase lo que pase nos redirige al registro
        header("Location:".base_url.'usuario/miPerfil?errorActualizarDatos='.($_SESSION['datos_result'] ? '0': '1'));
    }


    //Llamada a crear administrador
    public function crearAdmin(){
        Utils::isAdmin();
        require_once 'views/usuario/crear_admin.php';
    }

    //Guardar administrador
    public function saveAdmin(){
        Utils::isAdmin();
        if(isset($_POST)){
            //Comprobamos que los campos que llegan por POST existen
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            //Comprobar si alguno de los campos esta en false
            if($nombre && $apellidos && $email && $password){
                //Comprobar que nos llegan los datos 
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                
                //Llamada al metodo save del modelo y lo guarda en BBDD
                $save = $usuario->saveAdmin();

                if($save){
                    //Crear sesion complete
                    $_SESSION['register'] = "complete";
                    $_SESSION['crear_result'] = 1;
                }else{
                    //Crear sesion failed
                    $_SESSION['register'] = "failed";
                    $_SESSION['crear_result'] = 0;
                }
            }else{
                $_SESSION['register'] = "failed";
                $_SESSION['crear_result'] = 0;
            }

        }else{
            $_SESSION['register'] = "failed";
            $_SESSION['crear_result'] = 0;
        }
        //Pase lo que pase nos redirige al registro
        header("Location:".base_url.'usuario/gestion?errorCrearAdmin='.($_SESSION['crear_result'] ? '0': '1'));
    }

    //Metodo login
    public function login(){
        //Comprobamos si nos llegan por POST
        if(isset($_POST)){
            //Consulta a BBDD para comprobar las credenciales e identificacion del usuario
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            //Lanzamos el login que hace la consulta y devuelve el objeto del usuario identificado
            $identity = $usuario->login();
            
            //Crear una sesion para mantener al usuario identificado
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;

                //Si el usuario es admin creamos una sesion para el administrador
                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
                $_SESSION['login_result'] = 1;
            }else{
                $_SESSION['login_result'] = 0;
            }
        }  
        //url con el error para el alert
        header("Location:".base_url.($_SESSION['login_result'] ? '': 'usuario/acceso?errorLogin=1'));
    }

    //Reestablecer contraseña usuario
    public function reestablece(){
        if(isset($_POST['email'], $_POST['dni'], $_POST['nuevaPassword'])){
            $email = $_POST['email'];
            $dni = $_POST['dni'];
            $nuevaPassword = $_POST['nuevaPassword'];
    
            $usuario = new Usuario();
            $result = $usuario->updatePass($email, $dni, $nuevaPassword);
    
            if($result){
                $_SESSION['crear_result'] = 1;
                header("Location: " . base_url . 'usuario/acceso?errorNuevaPassUser='.($_SESSION['crear_result'] ? '0': '1'));
                exit;
            } else {
                $_SESSION['crear_result'] = 0;
                header("Location: " . base_url . 'usuario/registro?errorNuevaPassUser='.($_SESSION['crear_result'] ? '0': '1'));
                exit;
            }
        } else {
            $_SESSION['crear_result'] = 0;
            header("Location: " . base_url . 'usuario/registro?errorNuevaPassUser='.($_SESSION['crear_result'] ? '0': '1'));
            exit;
        }
    }

    //Cambiar contraseñas desde administrador
    public function cambiarPassAdmin(){
        Utils::isAdmin();
    
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $nuevaPass = $_POST['nuevaPassword'];
    
            $usuario = new Usuario();
            $usuario->setId($id);
            $result = $usuario->cambiarPassUser($id, $nuevaPass);
    
            if ($result) {
                $_SESSION['crear_result'] = 1;
                header("Location: " . base_url . 'usuario/gestion?errorNuevaPassAdmin='.($_SESSION['crear_result'] ? '0': '1'));
                
                exit();
            } else {
                // Manejar el caso en el que no se pudo cambiar la contraseña
                $_SESSION['crear_result'] = 1;
            }
        }
    
        header("Location: " . base_url . 'usuario/gestion?errorNuevaPassAdmin='.($_SESSION['crear_result'] ? '0': '1'));
        exit();
    }
    
    //Cerrar session
    public function logout(){
        if(isset($_SESSION['identity']) || isset($_SESSION['admin'])){
            if(isset($_SESSION['identity'])){
                unset($_SESSION['identity']);
                
            }
            
            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }
            $_SESSION['logout_result'] = 1;

        }else{
            $_SESSION['logout_result'] = 0;
        }
        header("Location:".base_url);
	}
    
    //Gestion de usuarios por el administrador
    public function gestion(){
        Utils::isAdmin();

        $usuario = new Usuario();
        $usuarios = $usuario->getAll();

        require_once 'views/usuario/gestionUsuarios.php';
    }

    //Elimina el usuario deseado por el admin
    public function eliminar(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);

            $delete = $usuario->delete();

            if($delete){
                $_SESSION['delete'] = 'complete';
            }else{
                $_SESSION['delete'] = 'failed';
            }
        }else{
            $_SESSION['delete'] = 'failed';
        }
        header("Location:".base_url.'usuario/gestion');
    }

    //Carga la vista de mi perfil
    public function miPerfil() {
        // Verificar si el usuario está autenticado
        if (isset($_SESSION['identity'])) {
            // Obtener el objeto Usuario de la sesión
            $usuario = new Usuario();
            $usuario->setId($_SESSION['identity']->id);
    
            // Obtener los datos del usuario desde la base de datos
            $usuarioModelo = new Usuario();
            $usuario = $usuarioModelo->getOne($usuario);
    
            $tarjetaFormateada = chunk_split($usuario->tarjeta, 4, ' ');

            // Cargar la vista y pasar los datos del usuario
            require_once 'views/usuario/mi_perfil.php';
        } else {
            // El usuario no está autenticado, redireccionar a la página de inicio de sesión
            header("Location: " . base_url . "usuario/acceso");
        }
    }

    public function editar(){
        $edit = true;
        require_once 'views/usuario/datos_usuario.php';
    }
}

