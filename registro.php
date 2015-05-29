<!DOCTYPE HTML>
<html>
<head>
	<title>AW-login php</title>
	 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	 <style>
	 	.login {
	 		display: block;
	 		width: 40em;
	 		margin-left: auto;
	 		margin-right: auto;
	 		border: 2px solid #000;
	 	}
	 	.login input {
	 		width: 65%;
	 	}
	 </style>
</head>
<body>
<?php

	session_start();

	if (session_id()) {
		$nombreusuario = $_POST["username"];
		$pass = $_POST["password"];

		// Conexión con la bbdd
		$connection = @mysqli_connect("localhost", "blas", "blasblas", "mis-usuarios");

		if($connection) {
			$query = "SELECT * FROM usuarios WHERE nombre='" . $nombreusuario . "'";

			if ($result = @mysqli_query($connection, $query)) {

				$usuario = @mysqli_fetch_object($result);

				if($usuario) {
					echo "Ese usuario ya existe";
				}
				else {
					$insert = "INSERT INTO usuarios (nombre, psswrd) VALUES (nombre='" . $nombreusuario . "', psswrd='" . $pass . "')";
					echo "</br> insert: " . $insert . "</br>";

					if ($inserted = @mysqli_query($connection, $insert)) {
						echo "Usuario registrado correctamente: " . mysqli_insert_id($connection);
					}
					else {
						echo "Error registrando el usuario";
					}
				}
			}
			else {
				echo "Error al iniciar sesion";
			}

			@mysqli_close($connection);
		}
		else {
			echo "Error al conectar con la base de datos";
		}
	}
	else {
		echo "Inicie sesíón primero";
	}
?>
</body>
</html>
