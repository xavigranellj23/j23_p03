<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Usuarios</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <style>
        a {color: #4F6187;}
      </style>
  </head>
  <body>

<?php
//se continúa la sesión
session_start();

//si no está instanciada la sesión
if(!isset($_SESSION['sUser'])){
  //comprueba si está vacia la sesión
  if(empty($_SESSION['sUser'])){
    //en caso afirmativo, redirige a index para login
    header('location: index.php');
  }
}

//conexión a la base de datos o mensaje en caso de error
$conexion = mysqli_connect('localhost','root','DAW22015','bd_pr02_intranet') or die ('No se ha podido conectar'. mysql_error());

//Sentencia para mostrar todos los usuarios de la tabla tbl_usuario
$sql = "SELECT * FROM tbl_usuario WHERE id_usuario=$_REQUEST[id]";


?>
<!--INICIO WEB -->
<!DOCTYPE html>
<html>
  <head>
      <title>Oxford Intranet</title>
      <meta lang="es">
      <meta charset="utf-8">
      <meta name="author" content="Xavi">
      <meta name="description" content="Proyecto2_intranet">
      <link rel="icon" type="image/png" href="img/icon.png">
      <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
      <script type="text/javascript" src="js/funcion.js"></script>
  </head>
    <body>

<a name="top">
        <!--BARRA NEGRA SUPERIOR -->
      <div id="barraNegra">
        <div id="barraLogin">
          <ul id="listaLogin">
            <li id="identificate">Hola <?php echo $_SESSION['sUser']?> </li>
            <li><a href="php/salir.php"><img src="img/exit.png" alt="Salir" title="Salir" /></a></li>
          </ul>
        </div>
      </div>

        <!--BARRA DE MENÚ -->
      <header>
        <section id="cabecera">
          <figure>
            <a href="main.php"><img src="img/logo.png"/></a>
          </figure>
          <nav>
            <ul>
              <a href="main.php"><li>INICIO</li></a>
              <a href="reserva.php"><li>RESERVAS</li></a>
              <a href="usuarios.php"><li>USUARIOS</li></a>
            </ul>
          </nav>
        </section>
      </header>
      <div id="barraNegraDatos">
         <div id="barraOpciones">

         </div>
      </div>
        <main>
        	<section id="centro">
             
            <!-- PARTE DONDE SE VA A MOSTRAR LA INFORMACIÓN -->
            <?php
            //consulta de datos según el filtrado
              $datos = mysqli_query($conexion,$sql);
              //si se devuelve un valor diferente a 0 (hay datos)
              if(mysqli_num_rows($datos)>0){

            ?>
            
            <br/>
            <div id="divMaterialReserva">
                <table>
                  <tr>
                    <td><b>Nombre:</b></td>
                    <td><b>Apellido:</b></td>
                    <td><b>Email:</b></td>
                    <td style="width:770px"><b>¿Seguro que quiere eliminar este usuario?</b><td>
                  </tr>
                  <tr>
                  	<?php
                  	$mostrar = mysqli_fetch_array($datos);
                  	?>
                  	<td style="width:370px"> <br/><?php echo $mostrar['nombre']; ?><br/></td>
                  	<td style="width:370px"> <br/><?php echo $mostrar['apellido']; ?><br/></td>
                  	<td style="width:370px"> <br/><?php echo $mostrar['email']; ?><br/></td>


                    </td>
                    <td style="width:370px"> <?php echo "<a href='eliminar.proc.php?id_usuario=$_REQUEST[id]'><font color='blue'>Sí, estoy seguro</a>"; ?></td>
                    <td style="width:370px"> <a href="usuarios.php"><font color="blue">Cancelar</a> </td>

                  </tr>

                </table>
            </div>
            <?php

          }else{
            ?>
            <br/>
            <div id="divMaterialReserva">
                <table>
                  <tr>
                    <th>
                    <p><img src="img/info.png" id="info" alt="info" title="info" /> NO HAY DATOS QUE MOSTRAR </p>
                    </th>
                  </tr>
                </table>
            </div><?php
              }
            ?>
                    </form>
        	</section>
        </main>
    </body>
</html>