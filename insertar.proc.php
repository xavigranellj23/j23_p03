<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Insertar</title>
	</head>
	<body>
		<?php
			//realizamos la conexión con mysql
			$con = mysqli_connect('localhost', 'root', 'DAW22015', 'bd_pr02_intranet');
			$sql = "INSERT INTO tbl_usuario (Nombre, Apellido, email, password, id_tipo_usuario) VALUES ('$_REQUEST[nombre]', '$_REQUEST[apellido]', $_REQUEST[email], $_REQUEST[password]), '$_REQUEST[tip]'";

			//echo $sql;

			//lanzamos la sentencia sql
			$datos = mysqli_query($con, $sql);

			header("location: usuarios.php")
		?>
	</body>
</html>