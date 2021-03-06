

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

//Sentencia $sql para seleccionar el tipo_usuario de la tabla tbl_tipo_usuario
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
              //si se devuelve un valor diferente a 0 (hay datos)
              if(mysqli_num_rows($datos)>0){
                $mostrar=mysqli_fetch_array($datos);
            ?>
            <form name="insertar" action="insertar.proc.php" method="get">
            <input type="hidden" name="id" value="<?php echo $mostrar['id_usuario']; ?>">
            <br/>
            <div id="divMaterialReserva">
                <table>
                  <tr>
                    <td><b>Nombre:</b></td>
                    <td><b>Apellido:</b></td>
                    <td><b>Email:</b></td>
                    <td><b>Contraseña:</b></td>
                    <td><b>Tipo Usuario:</b><td>
                    <td><td>
                  </tr>
                  <tr>
                    <td style="width:370px"> <br/><input type="text" name="nom" size="15" maxlength="25"><br/></td>
                    <td style="width:370px"> <br/><input type="text" name="ape" size="15" maxlength="25"><br/></td>
                    <td style="width:370px"> <br/><input type="text" name="mail" size="15" maxlength="25"><br/></td>
                    <td style="width:370px"> <br/><input type="text" name="pass" size="15" maxlength="25"><br/></td>
                    
                    <td style="width:370px">
                      

                      <select name="tip">
                        <?php
                          //Rellenar datos del SELECT con los datos de la base de datos
                          $sqlTipo = "SELECT * FROM tbl_tipo_usuario";
                          //consulta del select
                          $query = mysqli_query($conexion,$sqlTipo);
                          //mientras por cada dato en el array $query
                          while ($mostrarOpciones = mysqli_fetch_array($query)) {
                          //crea una opción en el dato extraido de la base de datos
                          echo "<option value='$mostrarOpciones[id_tipo_usuario]'>$mostrarOpciones[tipo_usuario]</option>";
                            }
                          ?>
                    </select>

                    </td>
                    <!-- Botones para insertar usuario i volver, donde te volvera a la ventana de usuarios.php-->
                    <td style="width:370px"> <input type="submit" value="Insertar  Usuario"></td>
                    <td style="width:370px"> <button type="submit" href="usuarios.php">Volver</button></td>

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
