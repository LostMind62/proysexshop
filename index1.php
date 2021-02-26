<?php
include('conexionOracle.php');    /** 1. Se invoca la conexion a la base de datos */

session_start();  

  if (!isset($_SESSION["ID_USUARIO"])) 
  {
    header("location: login.php"); /** 3. Se invoca el login para realizar el inicio de sesion */
  }
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Base de Datos</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css"> 
      body{
        /*background: url(fondu.png);*/
        background: url(fondoo.jpg); 
        background-size: 100vw 100vh;
        background-attachment: fixed;
      }
      a{
        color: #FFFF00;
        padding: 5px 5px;
      }
      .baner{
        color: #FFFF00;
      }
      a:active{
        background: #2EFE64;
      }
      nav.menu{
        margin: 0;
        padding: 0;
        color: #FFFFFF;
      }
      nav.menu li{
        display: block;
        float: left;
        padding: 0 10px;
      }
      h1{
			
			color: #FFFFFF;
			font-weight: normal;
			font-size: 25pt;
		}
    </style>

  </head>
 <body>

    <section>
      <nav class="menu">
        <menu>
          <li ><?php require_once 'token.php'; ?> <br /><br /></li>
          <li><a href="index1.php">Inicio</a><br /><br /></li>

         <li><a href="agregarusuarios.php">Agregar usuarios</a><br /><br /></li>

         
          <li><a href="masproduct.php">Agregar Producto</a><br /><br /></li>
          <li><a href="salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
        </menu>
      </nav>

      <p><br/></p>
      <div class="container">
        
        <h1>Productos</h1>

        <table style="color: white" class="table table-bordered table-hover" id="mydata">
          <thead>
            <tr>
              <th>ID</th>
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Precio</th>
            </tr>
          </thead>
       <!--   <tfoot>
            <tr>
              <th>ID</th>
              <th>Marca</th>
              <th>Nombre</th>
              <th>Año</th>
              <th>Numero de puertas</th>
              <th>Color</th>
            </tr>
          </tfoot>-->
          <tbody>

          <?php
            $query="SELECT * FROM Productos";
            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            //echo '<script type="text/javascript">alert('.$caca.');</script>';
            //para obtener un numero de filas

                while ($rows=oci_fetch_array($stid, OCI_ASSOC))
              {
        
          ?>s
                <td> <?php echo $rows['ID_PRODUCTO']; ?></td>
                <td> <img style="width: 20%;height: 20%;" src="<?php echo $rows['SRC']; ?>"></td>
                <td> <?php echo $rows['NOMBRE']; ?></td>
                <td> <?php echo $rows['CANTIDAD']; ?></td>
                <td>$<?php echo $rows['PRECIO']; ?></td>
                <td>
                  <a href="agregar.php?edited=1&id_producto=<?php echo $rows['ID_PRODUCTO']; ?>">Editar</a> |
                  <a href="agregar.php?deleted=1&id_producto=<?php echo $rows['ID_PRODUCTO']; ?>">Eliminar</a>
                </td>

              </tr>
          <?php
              }
             
          ?>
            
          </tbody>

        </table>s

      </div>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="js/jquery.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jquery.dataTables.min.js"></script>
      <script src="js/dataTables.bootstrap.min.js"></script>
      <script>
      	$('#mydata').dataTable();
      </script>
    </section>
  </body>
</html>