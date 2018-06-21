<?php

class db
{
    public static function conexion(){
        $conexion = new mysqli('localhost', 'root', '', 'avap', '3306');
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}