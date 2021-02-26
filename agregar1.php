<?php 
include('conexionOracle.php');    /** 1. Se invoca la conexion a la base de datos */

$target_dir = "subir/";
$target_file = $target_dir . basename($_FILES["imagen"]["name"]);

move_uploaded_file($_FILES["imagen"]["tmp_name"],$target_file);

  $nombre=htmlspecialchars($_POST['nombre']);
  $cantidad=htmlspecialchars($_POST['cantidad']);
  $precio=htmlspecialchars($_POST['precio']);

$sql = "insert into Productos values (Productos_SEQ.nextval, '$nombre', $cantidad, $precio,'$target_file')";
$stid = oci_parse($conn, $sql);
$resultUsuario = oci_execute($stid);
header("location: index1.php");
 ?>