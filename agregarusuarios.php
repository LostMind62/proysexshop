<?php

	session_start();
	include('conexionOracle.php');

	if (!isset($_SESSION["ID_USUARIO"])) {
		header("location: index1.php");
	}
	
	$bandera = false;

	if (!empty($_POST)) 
	{
		//CODIGO PROTEGIDO A XSS
		$nombre = htmlspecialchars($_POST['nombre']);/** 8. cada vez que agregamos el usuario siempre  se agrega la funcion HTMLSPECIALCARACTER*/
		$email = htmlspecialchars($_POST['email']);
		$usuario = htmlspecialchars($_POST['usuario']);
		$password = htmlspecialchars($_POST['password']);
		$tipo_usuario = $_POST['tipo_usuario'];	
		$sha1_pass = sha1($password);

		$error = '';

		$query = "SELECT id_usuario FROM usuarios WHERE usuario = '$usuario'"; /**9 Se hace comprobacion de usuarios existentes */
		$stid = oci_parse($conn, $query);
		oci_execute($stid);
		$rows = oci_fetch_array($stid, OCI_ASSOC);

		if ($rows){
			$error = "El usuario ya existe";
		}else{
			$sqlUsuario = "insert into Usuarios values (Usuarios_SEQ.nextval, '$tipo_usuario', '$nombre', '$email', '$usuario', '$sha1_pass')";
			$stid = oci_parse($conn, $sqlUsuario);
			
			$resultUsuario = oci_execute($stid);

			if ($resultUsuario) 
			{
				$bandera = true;
			}else{
				$error = "Error al Registrar";
			}
		}
	}
?>

<html>
<head>
	<title>Registro Nuevo</title>
  
	<script>
function validarNombre()			/**10 Validacion de cada campo al llenar el registro de nuevo usuario */
		{
			valor = document.getElementById("nombre").value;
			if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
				alert('Falta Llenar nombre');
				return false;
			}else{ return true;}
		}
		function validarEmail()
		{
			valor = document.getElementById("email").value;
			if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
				alert('Falta Llenar correo');
				return false;
			}else{ return true;}
		}

		function validarUsuario()
		{
			valor = document.getElementById("usuario").value;
			if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
				alert('Falta Llenar Usuario');
				return false;
			}else{ return true;}
		}

		function validarPassword()
		{
			valor = document.getElementById("password").value;
			if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
				alert('Falta Llenar Password');
				return false;
			}else{ 
				valor2 = document.getElementById("con_password").value;
				if (valor == valor2) 
					{
						return true;
					}else{ alert('Las contraselas no coinciden'); return false;}

			}
		}

		function validarTipoUsuario()
		{
			indice = document.getElementById("tipo_usuario").value;

			if(indice == null || indice==0) {
				alert('Seleccione tipo de usuario');
				alert(indice);
				return false;
			}else{ return true;}
		}

		function validar()
		{
			if (validarNombre() && validarEmail() && validarUsuario() && validarPassword() && validarTipoUsuario())
			{
				document.registro.submit();
			}
		}

	</script>

	<style>
		*{
			margin: 0px;
			padding: 0px;
		}
		body{
			background: url(fondoo.jpg);
			background-size: 100vw 100vh;
			background-attachment: fixed;
		}
		form{
			/*background: #E3F6CE;*/
			width: 380px;
			border: 3px solid #FD87FF;
			margin: 30px auto;
			padding: 40px 30px; 
			box-sizing: border-box;
		}
		form h1{
			text-align: center;
			font-weight: normal;
			color: #31B404;
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
		nav.menu1{
			width: 890px;
			height: 50px;
        	margin: 0;
       		padding: 0;
      	}
      	nav.menu1 li{
       		display: block;
        	float: left;
        	padding: 30 10px;
      	}
		label{
			color: #FFFFFF;
		}
		.btn{
   	 	text-decoration: none;
		/font-weight: 600;
		font-size: 20px;
		color: #FFFF00;
		background-color: #Fd87ff;
		border-radius: 6px;
		border: 2px solid #FD87FF;
  		}
		form h1{
			text-align: center;
			color: #FFFFFF;
			font-weight: bold;
			font-size: 30pt;
		}
	</style>

</head>
<body>

<section>
	<nav class="menu1">
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

	<form id="registro" name="registro" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<div>

		<h1>Nuevo Usuario</h1>
		<!-- solo que acepte caracteres que le indique con el pattern -->
			<br /><br />
			<label>Nombre:</label>
			<input id="nombre" type="text" name="nombre" required pattern="[A-Za-z0-9]{1,15}">
		</div><br />
			<div>

		<label>Correo:</label>
			<input id="email" type="text" name="email" required pattern="[A-Za-z0-9]{1,15}">
		</div><br />

			<label>Usuario:</label>
			<input id="usuario" type="text" name="usuario" required pattern="[A-Za-z0-9]{1,15}">
		</div><br />

		<div>
			<label>Password:</label>
			<input id="password" type="password" name="password" required pattern="[A-Za-z0-9]{1,15}">
		</div><br />

		<div>
			<label>Confirmar Password:</label>
			<input id="con_password" type="password" name="con_password" required pattern="[A-Za-z0-9]{1,15}">
		</div><br />

		<div >
			<label>Tipo Usuario:</label>
			<select id="tipo_usuario" name="tipo_usuario">
				<option value="0">Seleccione tipo de usuario...</option>
					<option  value="1">Normal</option>
					<option value="2">Administrador</option>
			</select>
		</div><br />

		<div><input class="btn" name="registrar" type="button" value="Registrar" onClick="validar();"></div>

	</form>

	<?php if($bandera){ ?>
		<?php echo '<script type="text/javascript">alert("Agregado correctamente");</script>'; ?>
		<?php }else{ ?>
		<br />
		<div style="font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
	<?php } ?> 

</section>
</body>
</html>
