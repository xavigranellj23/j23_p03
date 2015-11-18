<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Modificar</title>
	</head>
	<body>
		<?php
			$con = mysqli_connect('localhost', 'root', 'DAW22015', 'bd_pr02_intranet');
			$sql = "UPDATE tbl_usuario SET nombre='$_REQUEST[nombre]', apellido='$_REQUEST[apellido]', email=$_REQUEST[email], password=$_REQUEST[password], id_tipo_usuario=$_REQUEST[tip] WHERE id_usuario=$_REQUEST[id]";

			echo $sql;

			//lanzamos la sentencia sql
			$datos = mysqli_query($con, $sql);

		//header("location: main.php")

		?>
	</body>
</html>