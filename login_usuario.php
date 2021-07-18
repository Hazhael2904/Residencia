<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/master.css">
	<title>Login</title>
</head>
<body>
	
	<div class="login-box">
		<img class="avatar" src="img/logo3.jpg" alt="logo">
		<h1>LOGIN</h1>
		<form action="login_user.php" method="POST">

			<label for="email">Correo</label>
			<input type="text" name="email" placeholder="Ingresa su Correo">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Ingresa Contraseña">

            <input type="submit" value="Ingresar">

            <a href="registro.php">¿Ya tienes una cuenta?</a>
		</form>
	</div>
</body>
</html>