<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Eliminar</title>
	</head>
	<body>
		<?php
			//Conexión con mysql
			$con = mysqli_connect('localhost', 'root', 'DAW22015', 'bd_pr02_intranet');

			//Esta consulta devuelve todos los datos del producto cuyo campo clave id_usuario es igual a la id que nos llega por la barra de direcciones
			$sql = "DELETE FROM tbl_usuario WHERE id_usuario=$_REQUEST[id_usuario]";


			//Sentencia sql
			$datos = mysqli_query($con, $sql);
			
			if(mysqli_affected_rows($con)==1){
				header("location:main.php");
				
			} elseif(mysqli_affected_rows($con)==0){
				echo "No se ha eliminado ningún producto por que no existe en la BD";
			} else {
				echo "Ha pasado algo raro";
			}

			//Cerramos la conexión con la base de datos
			mysqli_close($con);
		?>
		<br/><br/>
		<a href="usuarios.php">Volver</a>
	</body>
</html>