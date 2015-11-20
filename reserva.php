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

//Sentencia para mostrar todos los materiales de la tabla tbl_material
$sql = "SELECT DISTINCT tbl_reservas.id_reserva, tbl_reservas.id_material, tbl_usuario.email, tbl_reservas.hora_entrada, tbl_reservas.hora_salida, tbl_reservas.id_material, tbl_material.descripcion, tbl_material.disponible
        FROM tbl_reservas
        INNER JOIN tbl_usuario on tbl_usuario.id_usuario = tbl_reservas.id_usuario
        INNER JOIN tbl_material on tbl_material.id_material = tbl_reservas.id_material
        INNER JOIN tbl_tipo_material on tbl_material.id_tipo_material = tbl_material.id_tipo_material";


//comprobación si está instanciada la variable opciones (viene de un select de filtrado en el formulario de cabecera)
if(isset($_REQUEST['opciones'])){
  //si los valores son mayores de 0,
  if ($_REQUEST['opciones']>0) {
    //se añadirá a la consulta según: 0 - Aulas, 1 - Material informático
    $sql .= " WHERE tbl_material.id_tipo_material =".$_REQUEST['opciones'];
  }
}

//consulta para filtrado de reservado o devuelto
if(isset($_REQUEST['devuelto'])){
    $sql .= " AND tbl_material.disponible =".$_REQUEST['devuelto'];
  }

$sql .= " ORDER BY tbl_reservas.hora_entrada DESC";

?>
<!--INICIO WEB -->
<!DOCTYPE html>
<html>
  <head>
      <title>Oxford Intranet</title>
      <meta lang="es">
      <meta charset="utf-8">
      <meta name="author" content="Felipe, Xavi, Germán">
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

           <!-- FORMULARIO SELECT PARA FILTRAR EL CONTENIDO -->
           <form action="reserva.php" method="get">
             <select name="opciones">
               <option value="" disabled selected>Filtrar por...</option>
               <option value="0">Todo</option>
               <?php
                  //Rellenar datos del SELECT con los datos de la base de datos
                  $sqlTipo = "SELECT * FROM tbl_tipo_material";
                  //consulta del select
                  $query = mysqli_query($conexion,$sqlTipo);
                  //mientras por cada dato en el array $query
                  while ($mostrarOpciones = mysqli_fetch_array($query)) {
                  //crea una opción en el dato extraido de la base de datos
                  echo "<option value='$mostrarOpciones[id_tipo_material]'>$mostrarOpciones[tipo]</option>";
                  }
                ?>
              </select>
              <select name="devuelto">
                <option value="" disabled selected>Filtrar por...</option>
                <option value="0">Devuelto</option>
                <option value="1">Reservado</option>
              </select>
              <input type="submit" name="name" value="Mostrar">
           </form>
         </div>
      </div>
        <main>
        	<section id="centro">
            <!-- PARTE DONDE SE VA A MOSTRAR LA INFORMACIÓN -->
            <?php
            //consulta de datos según el filtrado
              $datos = mysqli_query($conexion,$sql);
              //si se devuelve un valor diferente a 0 (hay datos)
              if(mysqli_num_rows($datos)!=0){
                while ($mostrar = mysqli_fetch_array($datos)) {
            ?>
            <br/>
            <div id="divMaterialReserva">
                <table>
                  <tr>
                    <td>Id Reserva</td>
                    <td>Descripción</td>
                    <td>Reservado</td>
                    <td>Devuelto</td>
                    <td>Disponible</td>
                    <td>Usuario</td>
                  </tr>
                  <tr>
                    <td style="width:80px"><?php echo $mostrar['id_reserva'];  ?></td>
                    <td style="width:207px"><?php echo utf8_encode($mostrar['descripcion']); ?></td>
                    <td style="width:207px"><?php echo $mostrar['hora_entrada']; ?></td>
                    <td style="width:207px"><?php echo $mostrar['hora_salida']; ?></td>
                    <td style="text-align:center;"><?php
                      if(!$mostrar['disponible']){
                        echo "<img src='img/ok.png' alt='Ok' title='Ok' />";
                      }else {
                        echo "<img src='img/ko.png' alt='Ko' title='Ko' />";
                      }
                    ?></td>
                    <td><?php echo $mostrar['email']; ?></td>
                  </tr>
                </table>
            </div>
            <?php
            }
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
