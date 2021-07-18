<?php
    include_once 'conexion.php';

    if(isset($_GET['idcliente'])){
    	$id=(int) $_GET['idcliente'];

    	$buscar_id=$con->prepare('SELECT * FROM cliente WHERE idcliente=:idcliente LIMIT 1');
    	$buscar_id->execute(array(
    		':idcliente'=>$id
    	));
    	$resultado=$buscar_id->fetch();
    }else{
    	header('Location: clientes.php');
    }

    if(isset($_POST['guardar'])){
    	$nombre=$_POST['nombre'];
    	$apellido1=$_POST['apellido1'];
    	$apellido2=$_POST['apellido2'];
    	$correo=$_POST['correo'];
    	$password=$_POST['password'];
    	$telefono=$_POST['telefono'];
    	$direccion=$_POST['direccion'];
    	$FechaRegistro=$_POST['FechaRegistro'];
    	$Estatus=$_POST['Estatus'];
    	$idcliente=(int) $_GET['idcliente'];

    	if(!empty($nombre) && !empty($apellido1) && !empty($apellido2) && !empty($correo) && !empty($password) && !empty($telefono) && !empty($direccion) && !empty($FechaRegistro) && !empty($Estatus) ){

    		if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
    			echo"<script> alert('Correo no valido');</script>";
    		}else{
    			$consulta_update=$con->prepare('UPDATE cliente SET 
    				nombre=:nombre,
    				apellido1=:apellido1,
    				apellido2=:apellido2,
    				correo=:correo,
    				password=:password,
    				telefono=:telefono,
    				direccion=:direccion,
    				FechaRegistro=:FechaRegistro,
    				Estatus=:Estatus
    				WHERE idcliente=:idcliente;'
    			);
    			$consulta_update->execute(array(
    				':nombre' =>$nombre,
    				':apellido1' =>$apellido1,
    				':apellido2' =>$apellido2,
    				'correo' =>$correo,
    				':password' =>$password,
    				':telefono' =>$telefono,
    				':direccion' =>$direccion,
    				':FechaRegistro' =>$FechaRegistro,
    				':Estatus' =>$Estatus,
    				':idcliente' =>$id
    			));
    			header('Location: clientes.php');
    		}
    	}else{
    		echo "<script> alert('Los campos estan vacios');</script>";
    	}
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/solicitud.css">
	<title>Editar Cliente</title>
</head>
<body>
<header>
		<div class="logo">
				<a href="#"><img src="../img/logo.png" width="150" alt=""></a>
				<a href="#">C-PRO ASOCIADOS</a>
                
			</div>
		<nav class="navegacion">
			<ul class="menu">
				<li><a href="index.php">Inicio</a>
				</li>
				<li><a href="#">Solicitudes</a>
                    <ul class="submenu">
                    	<li><a href="informacion.php">Información</a></li>
                    	<li><a href="solicitud_proyecto.php">Proyecto</a></li>
                    </ul>
				</li>
				<li><a href="servicios.html">Servicios</a></li>
				<li><a href="proyectos.php">Proyectos</a>
				</li>
				<li><a href="indexcalend.html">Calendario</a>
					<ul class="submenu">
						<li><a href="cita.php">Citas</a></li>
					</ul>
				</li>
				<li><a href="#">Usuarios</a>
                    <ul class="submenu">
                    	<li><a href="usuarios.php">Usuarios</a></li>
                    	<li><a href="personal.php">Personal</a></li>
                    	<li><a href="clientes.php">Clientes</a></li>
                    </ul>
				</li>
				<li><a href="login_usuario.php">Iniciar Sesión</a>
                    <ul class="submenu">
                    	<li><a href="../cerrar_sesion.php">Cerrar Sesión</a></li>
                    </ul>
				</li>
			</ul>
		</nav>
	</header>
	<div class="contenedor">
		<h2>Información del Cliente</h2>
		<form action="" method="post">

			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre'];?>" class="input_text">
			</div>

			<div class="form-group">
				<input type="text" name="apellido1" value="<?php if($resultado) echo $resultado['apellido1'];?>" class="input_text">
			</div>

			<div class="form-group">
				<input type="text" name="apellido2" value="<?php if($resultado) echo $resultado['apellido2'];?>" class="input_text">
			</div>

			<div class="form-group">
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo'];?>" class="input_text">
			</div>

			<div class="form-group">
				<input type="password" name="password" value="<?php if($resultado) echo $resultado['password'];?>" class="input_text">
			</div>

			<div class="form-group">
				<input type="text" name="telefono" value="<?php if($resultado) echo $resultado['telefono'];?>" class="input_text">
			</div>

			<div class="form-group">
				<input type="text" name="direccion" value="<?php if($resultado) echo $resultado['direccion'];?>" class="input_text">
			</div>

			<div class="form-group">
				<input type="date" name="FechaRegistro" value="<?php if($resultado) echo $resultado['FechaRegistro'];?>" class="input_text">
			</div>

			<div class="form-group">
				<input type="text" name="Estatus" value="<?php if($resultado) echo $resultado['Estatus'];?>" class="input_text">
			</div>

			<div class="btn__group">
				<a href="clientes.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>