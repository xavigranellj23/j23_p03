<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Ejemplo de formularios con datos en BD</title>
	</head>
	<body>
		<?php
			//realizamos la conexión con mysql
			$con = mysqli_connect('localhost', 'root', 'DAW22015', 'BD_exemple');

			//esta consulta devuelve todos los datos del producto cuyo campo clave (pro_id) es igual a la id que nos llega por la barra de direcciones
			$sql = "DELETE FROM producto WHERE pro_id=$_REQUEST[id]";

			//mostramos la consulta para ver por pantalla si es lo que esperábamos o no
			//echo "$sql<br/>";

			//lanzamos la sentencia sql
			$datos = mysqli_query($con, $sql);
			
			if(mysqli_affected_rows($con)==1){
				header("location:index.php");
				//echo "Producto con id=$_REQUEST[id] eliminado!";
			} elseif(mysqli_affected_rows($con)==0){
				echo "No se ha eliminado ningún producto por que no existe en la BD";
			} else {
				echo "Ha pasado algo raro";
			}

			//cerramos la conexión con la base de datos
			mysqli_close($con);
		?>
		<br/><br/>
		<a href="index.php">Volver</a>
	</body>
</html>