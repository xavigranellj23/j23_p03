<?php
//conexión con la base de datos
$conexion = mysqli_connect('localhost','root','DAW22015','bd_pr02_intranet') or die ('No se ha podido conectar'. mysql_error());

//se comprueba la variable devuelta de validar_usuario.php en caso de login incorrecto
if(isset($_REQUEST['error'])){
  $fail = $_REQUEST['error'];
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
      <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen">
  </head>
    <body>
      <div id="barraNegra">
        <div id="barraLogin">
          <ul id="listaLogin">
            <li id="identificate"></li>
          </ul>
        </div>
      </div>
      <header>
        <section id="cabecera">
          <figure>
            <a href="index.php"><img src="img/logo.png"/></a>
          </figure>
          <nav>
            <ul>
              <li>INICIO</li>
              <li>HISTORIA</li>
              <li>CONTACTO</li>
            </ul>
          </nav>
        </section>
      </header>
        <main>
          <section id="centroLogin">
            <header id="headerLogin">
              <div id="headerCentro">
                <h2>INTRANET</h2>
              </div>
            </header>
            <div id="contenido">
              <div id="formCentro">

                <!-- FORMULARIO DE LOGIN -->
                <form id="formLogin" name="formLogin" action="php/validar_usuario.php" method="post">
                  <p>Usuario:</p>
                  <input id="user" class="user" type="email" name="user" size="30" value="" autofocus required autocomplete="off">
                  <p>Contraseña:</p>
                  <input id="pass" class="pass" type="password" name="pass" size="30" maxlength="10" value="" required  autocomplete="off">
                  <input type="submit" class="submit" name="entrar" value=" Entrar ">
                  <input type="reset" class="reset" name="borrar" value=" Borrar ">
                </form>
                <!-- FIN FORMULARIO -->

              </div>
            </div>
            <div id="error">
              <p>
                <?php
                  //si la variable $fail no está vacía, muestra el contenido
                  if(!empty($fail)){
                    echo $fail;
                  }?>
              </p>
            </div>
          </section>
        </main>
    </body>
</html>
