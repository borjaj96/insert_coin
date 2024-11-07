<?php
//Conexion a bbdd
class Database{
    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'insert_coin');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}