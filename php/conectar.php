<?php
$host="127.0.0.1";
$usu="root";
$pas="12345678";
$bd="RESTAURANTE";

$conexion=mysqli_connect($host,$usu,$pas,$bd);

if(mysqli_connect_errno()){
	
	echo"Error al conectarse a la BD ".mysqli_connect_error();
	
}else {
}

?>