<?php
//se continúa la sesión
session_start();

//se comprueba si la variable mensaje devuelto de reservar.php está instanciada.
//Si se ha devuelto, es que el insert ha sido correcto.
if(isset($_REQUEST['mensaje'])){
  //se comprueba si no está vacía
  if(!empty($_REQUEST['mensaje'])){
    //se guarda el contenido en la siguiente variable
    $mensaje = $_REQUEST['mensaje'];
    //se muestra un mensaje en un alert javascript
    echo "<script type='text/javascript'>alert('$mensaje')</script>";
    //destruimos la variable para evitar el alert al recargar la web
    unset($mensaje);
  }
}

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
$sql = "SELECT tbl_material.id_material, tbl_tipo_material.tipo, tbl_material.descripcion, tbl_material.disponible, tbl_material.incidencia, tbl_material.descripcion_incidencia
        FROM tbl_material
        INNER JOIN tbl_tipo_material ON tbl_tipo_material.id_tipo_material = tbl_material.id_tipo_material";
      /*  INNER JOIN tbl_usuario on tbl_usuario.id_usuario = tbl_reservas.id_usuario*/ /*tbl_usuario.email*/

//comprobación si está instanciada la variable opciones (viene de un select de filtrado en el formulario de cabecera)
if(isset($_REQUEST['opciones'])){
  //si los valores son mayores de 0,
  if ($_REQUEST['opciones']>0) {
    //se añadirá a la consulta según: 0 - Aulas, 1 - Material informático
    $sql .= " WHERE tbl_material.id_tipo_material = ".$_REQUEST['opciones'];
  }
}
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
              <?php
              if ($_SESSION['sUser'] == )

              if(!isset($_SESSION['sUser'])){
  //comprueba si está vacia la sesión
  if(empty($_SESSION['sUser'])){
    //en caso afirmativo, redirige a index para login
    header('location: index.php');
  }
}
              ?>
              <a href="usuarios.php"><li>USUARIOS</li></a>
            </ul>
          </nav>
        </section>
      </header>
      <div id="barraNegraDatos">
         <div id="barraOpciones">

           <!-- FORMULARIO SELECT PARA FILTRAR EL CONTENIDO -->
           <form action="main.php" method="get">
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

              <div id="divMaterial"><br/>
                <form id="formMaterial" action="php/reservar.php" method="get">
                  <div id="formQuery">
                    <div id="formQueryFoto">
                      <p><img class ="fotoMini" src="img/material/<?php echo $mostrar['id_material']; ?>.jpg" alt="" title"" /></p>
                    </div>
                    <div id="formQueryTexto">
                      <p id="formTituloMaterial"><?php echo utf8_encode($mostrar['descripcion']); ?><p>
                      <p>Disponibilidad: <?php
                        if(!$mostrar['disponible']){
                          echo "<img src='img/ok.png' alt='Ok' title='Ok' />";
                        }else {
                          echo "<img src='img/ko.png' alt='Ko' title='Ko' />";
                        }
                      ?><p>
                      <p>Incidencia:<?php
                        if($mostrar['incidencia']){
                          echo "Si";
                        }else {
                          echo "No";
                        }
                      ?><p>
                      <p>Tipo de incidencia:<?php echo utf8_encode($mostrar['descripcion_incidencia']); ?><p>
                        <!-- campo oculto para enviar el id_material -->
                      <input type="hidden" name="disponibilidad" value="<?php echo $mostrar['disponible']; ?>">
                      <input type="hidden" name="material" value="<?php echo $mostrar['id_material']; ?>">
                      <!-- Se comprueba el valor de disponible y se asigna un texto al botón -->
                      <input type="submit" id="reservar" name="reservar" value=<?php
                        if(!$mostrar['disponible']){
                          echo "Reservar";
                        }else {
                          echo "Devolver";
                        }
                        ?>>
                      <a href="#top"><img src="img/top.png" alt="Subir" title="Subir" /></a>
                    </div>
                  </div><br/>
                </form>
              </div><br/>
            <?php
                }
              }else{
                echo "No hay datos";
              }
            ?>
        	</section>
        </main>
    </body>
</html>
