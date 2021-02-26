<?php 

session_start();
include('conexionOracle.php');

// if (!isset($_SESSION["ID_USUARIO"])) {
// 		header("location: index1.php");
// 	}

$error="";

$id_producto="0";
$nombre="";
$cantidad="";
$precio="";


if (isset($_POST['btnguardar'])) 
{

	$nombre=htmlspecialchars($_POST['txtnombre']);
	$cantidad=htmlspecialchars($_POST['txtcantidad']);
	$precio=htmlspecialchars($_POST['txtprecio']);
	
	
	if ($_POST['txtid']=="0") 
	{
		$sql = "insert into Productos values (Productos_SEQ.nextval, '$nombre', $cantidad, $precio)";
		$stid = oci_parse($conn, $sql);
		$resultUsuario = oci_execute($stid);
		if ($resultUsuario) 
		{
			header('Refresh:0; index1.php');
		}
	}else{
		$sql="UPDATE Productos SET nombre='$nombre', cantidad=$cantidad, precio=$precio WHERE id_producto='{$_POST['txtid']}'";
		$stid = oci_parse($conn, $sql);
		$resultUsuario = oci_execute($stid);
		if ($resultUsuario) 
		{
			header('Refresh:0; index1.php');
		}
	}
}

//verificación de id para editar
if (isset($_GET['edited'])) 
{
	$query="SELECT * FROM Productos WHERE id_producto='{$_GET['id_producto']}'";
	$stid = oci_parse($conn, $query);
	oci_execute($stid);
	$rows=oci_fetch_array($stid, OCI_ASSOC);

	$id_producto= $rows['ID_PRODUCTO']; 
	$nombre=  $rows['NOMBRE']; 
	$cantidad= $rows['CANTIDAD']; 
	$precio= $rows['PRECIO'];

}

//verificación de id para eliminar
if (isset($_GET['deleted'])) 
{

	$query="DELETE FROM Productos WHERE id_producto='{$_GET['id_producto']}' ";
	$stid = oci_parse($conn, $query);
	$result = oci_execute($stid);
	
	
	if ($result) 
	{
		header('Refresh:0; index1.php');
	}
}

?>

<html>
<head>
	<title>Nuevo Producto</title>

	<style type="text/css">

			*{
				margin: 0px;
				padding: 0px;
			}
			form{
			width: 380px;
			border: 3px solid #FD87FF;
			margin: 30px auto;
			padding: 40px 30px; 
			box-sizing: border-box;
			}
			body{
				background: url(fondoo.jpg);
				background-size: 100vw 100vh;
				background-attachment: fixed;
				color: #FFFFFF;
			}
			form h1{
				text-align: center;
				font-weight: bold;
				color: #FFFFFF;
				font-size: 30pt;
				margin: 0;
			}

			form input{
				width: 200px;
				height: 25px;
				margin: 10px 30px;

			}
			a{
	        	color: #FFFF00;
	        	padding: 5px 10px;
	        	font-size: 16;
	     	}
	     	a:active{
	       		background: #2EFE64;
	     	}

			nav.menu2{
				width: 890px;
				height: 50px;
		        margin: 0;
		        padding-top: .80cm;

		    }
		     nav.menu2 li{
		        display: block;
		        float: left;
		        padding: 0 10px;

		    }
			
	</style>

</head>

<body>

<section>

	<nav class="menu2">
	<nav class="menu">
        <menu>
        <li><a href="index1.php">INICIO</a><br /><br /></li>

          <?php if($_SESSION['TIPOU']==2) { ?>
          <li><a href="agregarusuarios.php">AGREGAR USUARIOS</a><br /><br /></li>
          <?php } ?>

          <li><a href="agregar.php">AGREGAR PRODUCTOS</a><br /><br /></li>
          <li><a href="salir.php">CERRAR SESIÓN</a><br /><br /></li>
        </menu>
      </nav>
		
	</nav>


	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

	<h1>Nuevo Producto</h1>
		<table>
		<tr>
			<td colspan="2"><span style="color:red;"> <?php echo $error; ?> </span> </td>
		</tr>

			<tr>
				<td>Nombre</td>
				<td> <input type="text" name="txtnombre" value="<?php echo $nombre; ?>" required pattern="[A-Za-z0-9]{1,15}"> </td>
				<input type="hidden" name="txtid" value="<?php echo $id_producto; ?>" /> </td>
			</tr>
			<tr>
				<td>Cantidad</td>
				<td> <input type="text" name="txtcantidad" value="<?php echo $cantidad; ?>" required pattern="[0-9]+"> </td>
			</tr>
			<tr>
				<td>Precio</td>
				<td> <input type="text" name="txtprecio" value="<?php echo $precio; ?>" required pattern="[0-9]+"> </td>
			</tr>
		
			<tr>
				<td></td>
				<td> <input type="submit" value="Guardar" name="btnguardar"></td>
			</tr>
		</table>
	</form>
</section>
</body>
</html>




