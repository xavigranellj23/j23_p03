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
$sql = "SELECT DISTINCT *
        FROM tbl_usuario
        INNER JOIN tbl_tipo_usuario on tbl_tipo_usuario.id_tipo_usuario = tbl_usuario.id_tipo_usuario";

$sqlTipo2 = "SELECT * FROM tbl_usuario WHERE email = '$_SESSION[sUser]'"; 
//echo $sqlTipo2;
if(isset($_REQUEST['opciones'])){
  //si los valores son mayores de 0,
  if ($_REQUEST['opciones']>0) {
    //se añadirá a la consulta según: 0 - Usuarios, 1 - Administradores
    $sql .= " WHERE tbl_tipo_usuario.id_tipo_usuario =".$_REQUEST['opciones'];
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
      <meta name="author" content="Xavi">
      <meta name="description" content="Proyecto2_intranet">
      <link rel="icon" type="image/png" href="img/icon.png">
      <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
          a {color: #4F6187;}
        </style>
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
              <a href="main.php"><font color="white"><li>INICIO</li></a>
              <a href="reserva.php"><font color="white"><li>RESERVAS</li></a>
            </ul>
          </nav>
        </section>
      </header>
      <div id="barraNegraDatos">
         <div id="barraOpciones">

           <!-- FORMULARIO SELECT PARA FILTRAR EL CONTENIDO -->
           <form action="usuarios.php" method="get">
             <select name="opciones">
               <option value="" disabled selected>Filtrar por...</option>
               <option value="0">Todo</option>
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
              <input type="submit" name="name" value="Mostrar">
              <a href="insertar.php" ><font color="white"><i class='fa fa-plus-square fa-2x fa-pull-left fa-border' title='Añadir Usuario'></i></a>
           </form>


         </div>

      </div>
        <main>
        	<section id="centro">
             
            <!-- PARTE DONDE SE VA A MOSTRAR LA INFORMACIÓN -->
            <?php
            //consulta de datos según el filtrado
              $datos = mysqli_query($conexion,$sql);
              
              $datos2 = mysqli_query($conexion,$sqlTipo2);
              $mostrar2 = mysqli_fetch_array($datos2);
              //echo $mostrar2['id_tipo_usuario'];
              //si se devuelve un valor diferente a 0 (hay datos)
                while ($mostrar = mysqli_fetch_array($datos)) {
            ?>
            <br/>
            <div id="divMaterialReserva">
                <table>
                  <tr>
                    <td><b>Email:</b></td>
                    <td><b>Tipo Usuario:</b></td>
                    <td><b>Nombre:</b></td>
                    <td><b>Apellido:</b></td>
                    <td><b>Modificar:</b></td>
                    <td><b>Eliminar:</b></td>
                   
                  </tr>
                  <tr>
                    <td style="width:370px"><?php echo $mostrar['email'];  ?></td>
                    <td style="width:370px"><?php echo utf8_encode($mostrar['tipo_usuario']); ?></td>
                    <td style="width:370px"><?php echo $mostrar['nombre'];  ?></td>
                    <td style="width:370px"><?php echo $mostrar['apellido'];  ?></td>
                    <td style="width:370px">
                    <?php

                    switch ($mostrar2['id_tipo_usuario']) {
                    

                      case 2:

                          echo "<a href='modificar.php?id=$mostrar[id_usuario]'><i class='fa fa-pencil fa-2x fa-pull-left fa-border' title='Modificar'></i></a>";
                          break;

                      case 3:

                          echo "<a href='modificar.php?id=$mostrar[id_usuario]'><i class='fa fa-pencil fa-2x fa-pull-left fa-border' title='Modificar'></i></a>";
                          ?>
                          <td style="width:370px"><?php echo "<a href='eliminar.php?id=$mostrar[id_usuario]'><i class='fa fa-trash fa-2x fa-pull-left fa-border' title='Eliminar'></i></a>"; ?></td>
                          <?php
                        break;

                    }

                    ?>
                    </td>

                  </tr>
                </table>
            </div>
            <?php
            }
          ?>
        	</section>
        </main>
    </body>
</html>
