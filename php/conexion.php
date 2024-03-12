<?php

$db_host = "localhost";
$db_user = "admin";
$db_pass = "admin";
$db_name = "proyectoweb";
 
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
 
if(mysqli_connect_errno()){
	echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
}
