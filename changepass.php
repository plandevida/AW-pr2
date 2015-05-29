<!DOCTYPE HTML>
<html>
<head>
	<title>AW-login php</title>
	 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>
<?php

	session_start();

	if (session_id()) {

		$antiguaPass = $_POST["oldpass"];
		$nuevaPass = $_POST['newpass'];

		// Conexión con la bbdd
		$connection = @mysqli_connect("localhost", "blas", "blasblas", "mis-usuarios");

		if($connection) {
			if($_SESSION['username']) {
				$query = "SELECT * FROM usuarios WHERE nombre='" . $_SESSION['username'] . "'";
				echo "</br> query: " . $query;
				if ($result = mysqli_query($connection, $query)) {
					$usuario = @mysqli_fetch_object($result);
					if ($usuario && $usuario->psswrd == $antiguaPass) {

						// Actualización de la contraseña
						$update = "update usuarios set psswrd='" . $nuevaPass . "' where nombre='" . $usuario->nombre . "'";
						echo "</br> update: " . $update;
						if ($updated = @mysqli_query($connection, $update)) {
							echo "Contraseña actualizada correctamente";
						}
						else {
							echo "Error actualizando la contraseña";
						}
					}
					else if($usuario) {
						echo "Antigua contraseña incorrecta";
					}
				}
				else {
					echo "Error buscando el usuario";
				}
			}

			@mysqli_close($connection);
		}
		else {
			echo "Error al conectar con la base de datos";
		}
	}
	else {
		echo "Inicie sesión primero";
	}
?>
</body>
</html>
