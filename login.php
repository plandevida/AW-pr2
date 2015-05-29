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

	$nombreusuario = $_POST["username"];
	$pass = $_POST["password"];

	// Conexión con la bbdd
	$connection = @mysqli_connect("localhost", "blas", "blasblas", "mis-usuarios");

	if($connection) {
		$query = "SELECT * FROM usuarios WHERE nombre='" . $nombreusuario . "'";

		if ($result = @mysqli_query($connection, $query)) {

			$usuario = @mysqli_fetch_object($result);

			if ($usuario) {
				$usernamebbdd = $usuario->nombre;
				$passbbdd = $usuario->psswrd;

				// Comprobación de login
				if ($nombreusuario == $usernamebbdd && $pass == $passbbdd) {
					echo "Has iniciado sessión correctamente " . $nombreusuario;
					$_SESSION["username"] = $nombreusuario;
					echo "</br>";
					echo "</br>";
					echo "<form class=\"login\" action=\"changepass.php\" method=\"post\">Contraseña antigua: <input type=\"password\" name=\"oldpass\">Nueva contraseña: <input type=\"password\" name=\"newpass\"><input type=\"submit\" value=\"Cambiar contraseña\"></form>";
				}
				else {
					echo "Error al iniciar sesión";
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
?>
</body>
</html>
