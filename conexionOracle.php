<?php

$conn = oci_connect('system', 'system','localhost/xe');  /** 2. Aqui realizamos la conexion con el usuario, contraseña y ruta */

if(!$conn){
//echo 'connection error';
}
else{
//echo 'connection succesful';
}
?>