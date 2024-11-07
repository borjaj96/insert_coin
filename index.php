<?php
ob_start();
//Iniciamos la sesion
session_start();

// Carga autoload para tener acceso a todos los controladores
require_once 'autoload.php';

//Carga la BBD
require_once 'config/db.php';

//Cargar los parametros de la url
require_once 'config/parameters.php';

//Cargar utilidades
require_once 'helpers/utils.php';

//Cargamos el HEADER
require_once 'views/layout/header.php';


function show_error(){
    //Cargar el controlador de error si la pagina no existe
    $error = new errorController();
    $error->index();
}

//Compruebo si me llega el controlador por la URL
if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';

    //Si no existe el controller ni action
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    //Damos valor a la variable el valor por defecto de la constante de parametros controller_default
    $nombre_controlador = controller_default;
}else{
    show_error();
    exit();
}

//Compruebo si existe el controlador
if(class_exists($nombre_controlador)){
    //Creo el objeto
    $controlador = new $nombre_controlador();

    //Compruebo si me llega la accion
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();

        //Si no existe el controller ni action
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        //Carga la action por defecto de parameters
        $action_default = action_default;
        $controlador->$action_default();
    }else{
        show_error();
    }

}else{
    show_error();
}

//Cargamos el FOOTER
require_once 'views/layout/footer.php';