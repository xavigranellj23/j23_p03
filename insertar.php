

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
$sql = "SELECT * FROM tbl_tipo_usuario ORDER BY tipo_usuario ASC";


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
              ?>

            <form name="insertar" action="insertar.proc.php" method="get">

            <br/>
            <div id="divMaterialReserva">
                <table>
                  <tr>
                    <td>Nombre:</td>
                    <td>Apellido:</td>
                    <td>Email:</td>
                    <td>Contraseña:</td>
                    <td>Tipo Usuario:<td>
                    <td><td>
                  </tr>
                  <tr>
                    <td style="width:370px"> <br/><input type="text" name="nombre" size="15" maxlength="25"><br/></td>
                    <td style="width:370px"> <br/><input type="text" name="apellido" size="15" maxlength="25"><br/></td>
                    <td style="width:370px"> <br/><input type="text" name="email" size="15" maxlength="25"><br/></td>
                    <td style="width:370px"> <br/><input type="text" name="password" size="15" maxlength="25"><br/></td>
                    <td style="width:370px">
                        <select name="tip">
                        <?php

                        while ($tipo=mysqli_fetch_array($datos)){
                          echo "<option value='$tipo[id_tipo_usuario]'> $tipo[tipo_usuario]</option>";
                        }

                        ?>
                      </select>


                    </td>
                    <td style="width:370px"> <input type="submit" value="Guardar"></td>
                    <td style="width:370px"> <input type="submit" value="Cancelar" href="usuarios.php"></td>
                  </tr>
                </table>
                </form>
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
        	</section>

        </main>
    </body>
</html>
