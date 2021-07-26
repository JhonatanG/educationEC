<?php
class Conexion{
static public function conectar(){
//PDO=PERMITE ACCEDER A LA BASE DE DATOS
$link= new PDO("mysql:host=localhost;dbname=education8","root","");
$link -> exec("set names utf8");
return $link;
}

}