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

			//sentencia sql para insertar diferentes campos
			
			$sql = "INSERT INTO `tbl_usuario`(`nombre`, `apellido`, `email`, `password`, `id_tipo_usuario`) VALUES ('$_REQUEST[nom]', '$_REQUEST[ape]', '$_REQUEST[mail]', $_REQUEST[pass], $_REQUEST[tip])";


			//lanzamos la sentencia sql
			$datos = mysqli_query($con, $sql);

			header("location: usuarios.php")
		?>
	</body>
</html>