<?php 
include_once 'conexion.php';
$queryroles=("SELECT CONCAT(descripcion) nombrerol, idrol FROM roles");
$roles=$con->query($queryroles);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/masteregistrar.css">
	<title>Registrar Usuario</title>
</head>
<body>
	
	<div class="registrar-box">
		<h1>Registrar Usuario</h1>

		<form action="registrar_usuario.php" method="POST">
			<label for="name">Nombre del Usuario</label>
			<input type="text" name="nombre" id="nombre" placeholder="Nombre del Usuario">

			<label for="apellidos">Apellidos del Usuario</label>
			<input type="text" name="apellidos" id="apellidos" placeholder="Apellidos del Usuario">

			<label for="username">Usuario</label>
			<input type="text" name="usuario" id="usuario" placeholder="Nombre de Usuario">

            <label for="email">Email</label>
			<input type="text" name="email" id="email" placeholder="Ingresa su Correo">

			<label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Ingrese su Contraseña">

            <label for="date">Fecha de Registro</label>
            <input type="date" name="fecharegistro" id="fecharegistro">

            <label for="estatus">Estatus</label>
            <input type="text" name="estatus" id="estatus" placeholder="Estatus del Usuario">
            <label for="rol">Rol del Usuario</label>
            <select name="idrol">
               <?php
                 while ($rol=$roles->fetch(PDO::FETCH_ASSOC)): ?>
                   <option value="<?php echo $rol['idrol'];?>"><?php echo $rol['nombrerol'];?></option> 
                <?php endWhile;?>
            </select>

            <input type="submit" value="Registrar">

		</form>
	</div>
</body>
</html>