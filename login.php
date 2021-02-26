<?php

include('conexionOracle.php');

	session_start();
 
if (isset($_SESSION["id_usuario"]))
{
	header("location: index.php");
}

	if (!empty($_POST)) /**4. Se envia el formulario por metodo POST para hacerlo más seguro*/
	{
		$usuario = htmlspecialchars($_POST['usuario']);	/** 5. Utilizamos la funcion htmlspecialchar para quitar comillas o algun otro caracter   */ 
		$password = htmlspecialchars($_POST['password']);	/** */
		$error='';
		$sha1_pass = sha1($password);

		$query = "SELECT id_usuario, TIPOU FROM usuarios WHERE usuario = '$usuario' AND password = '$sha1_pass'";
		/**6. Realizamos la comparacion en la base de datos para poder iniciar la sesion */
		$stid = oci_parse($conn, $query);
		
		oci_execute($stid);
		$rows = oci_fetch_array($stid, OCI_ASSOC);

		/*while(oci_fetch_array($stid)){
			//echo $message = oci_result($stid,"ID_USUARIO");
		}*/

		if ($rows) 
		{
			$_SESSION['token']="<script> generatetoken(); </script>";
			$_SESSION['ID_USUARIO'] = $rows['ID_USUARIO'];
			$_SESSION['TIPOU'] = $rows['TIPOU'];	/**6. Realizamos la comparacion en la base de datos para poder iniciar la sesion */
			echo $_SESSION['ID_USUARIO'];
			echo $_SESSION['TIPOU'];

			header("location: index1.php");	
		}else{
			$error="Usuario o password son incorrectos";
		}
	}
?>

<html>
	<head>
		<title>Login</title>

		<style type="text/css">
			*{
				margin: 0px;
				padding: 0px;
			}
			body{
				background: url(fondoo.jpg); 	
				/*background: #5e2129;*/
				background-size: 100vw 100vh;
				background-attachment: fixed;
			}
			form{
				/*background: #4B088A;*/
				width: 350px;
				border: 5px solid #FD87FF;
				margin:130px auto; 
			}
			form h1{
				text-align: center;
				color: #FFFFFF;
				font-weight: normal;
				font-size: 40pt;
				margin: 20px 0px;
			}
			form h2{
				text-align: center;
				color: #FFFFFF;
				margin: 20px 0px;
			}
			form input{
				width: 280px;
				height: 35px;
				margin: 10px 30px;
				padding: 10px 10px;
				text-align: center;
			}
			
		</style>	
	</head>

  	<body>
  		
     	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "POST">
		
		<h1>SexShop</h1>
     	<h2>Inicia Sesion</h2>
    		<!--solo que acepte caracteres que le indique con el pattern -->
			<input type = "text" id="usuario" name = "usuario" placeholder="Usuario" required pattern="[A-Za-z0-9]{1,15}"></div>
	  		<br/>
			
			<input type = "password" id="password" name = "password" placeholder="Password" required pattern="[A-Za-z0-9]{1,15}"></div>
	  		<br/>
			
			<div><input type = "submit" name="login" value="Entrar"></div>
	  		<br/>
	  		
	  		<div style="font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
    	</form>
  	</body>
</html>