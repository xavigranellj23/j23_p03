<?php
//se inicia una sesión
session_start();

//se conecta con la base de datos
$conexion = mysqli_connect('localhost','root','DAW22015','bd_pr02_intranet') or die ('No se ha podido conectar'. mysql_error());

  //se crean las sesiones para las variables de usuario y password cogidas del formulario
  $_SESSION['sUser']= $_REQUEST['user'];
  $_SESSION['sPass'] = $_REQUEST['pass'];

  //sentencia SQL donde se compara las variables de sesión anteriores con los datos de la base de datos
  $sql = "SELECT * FROM tbl_usuario WHERE email='$_SESSION[sUser]' AND password='$_SESSION[sPass]'";

  // se realiza la consulta anterior
  $query = mysqli_query($conexion,$sql);

  //se comprueba la consulta anterior y si es 1, es que hay una coincidencia
    if(mysqli_num_rows($query)==1){
      // se redirige a la página main.php en caso de login correcto
      header('location: ../main.php');
    }else{
      //se redirige a la pantalla login incluyendo un mensaje de error
      header('location: ../index.php?error=No existe el usuario');
    }

?>
