<?php
//Para no tener que hacer requires de controladores
//se hace require de este archivo en el index y ya
//construye la ruta al archivo del controlador concatenando "controllers/" 
//con el nombre de la clase + ".php".
function controllers_autoload($className){
    include 'controllers/'. $className.'.php';
}

spl_autoload_register('controllers_autoload');