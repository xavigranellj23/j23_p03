<?php

//se continúa con la sesión
session_start();

//se destruye la sesión
session_destroy();

//se redirige a la pantalla login
header('location: ../index.php');

?>
