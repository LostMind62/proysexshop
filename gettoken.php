<?php 
// require_once 'token.php';
include('conexionOracle.php');
session_start();
if ($_SESSION['token']==NULL){
 $_SESSION['token']=substr(sha1(rand(10,100)),0,20);
 $var=$_SESSION['token'];
$sql = "insert into Tokens values (NULL,'$var')";
		$stid = oci_parse($conn, $sql);
		$resultUsuario = oci_execute($stid);
}
echo $_SESSION['token']."   este es tu token deseas cambiarlo?";

 ?>
 
