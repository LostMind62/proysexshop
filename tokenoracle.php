<?php 


include('conexionOracle.php');

session_start();

$p= htmlspecialchars($_POST['token']);
$sql = "insert into Tokens values (NULL,'$p')";
		$stid = oci_parse($conn, $sql);
		$resultUsuario = oci_execute($stid);
$_SESSION['token']=$p;
echo $p ."   NUEVO TOKEN GENERADO";
 ?>