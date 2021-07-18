<?php
    include_once 'conexion.php';

    if(isset($_POST['guardar'])){
    	$nombre=$_POST['nombre'];
    	$apellidos=$_POST['apellidos'];
    	$servicio=$_POST['servicio'];
    	$direccion=$_POST['direccion'];
    	$correo=$_POST['correo'];
    	$telefono=$_POST['telefono'];
    	$estatus=$_POST['estatus'];

    	if(!empty($nombre) && !empty($apellidos) && !empty($servicio) && !empty($direccion) && !empty($correo) && !empty($telefono) && !empty($estatus)){
    		if(!filter_var($correo,
    			FILTER_VALIDATE_EMAIL)){
                echo"<script> alert('Correo no valido');</script>";
    		}else{
    		$consulta_insert=$con->prepare('INSERT INTO solicitud_proyecto(nombre,apellidos,servicio,direccion,correo,telefono,estatus) VALUES(:nombre,:apellidos,:servicio,:direccion,:correo,:telefono,:estatus)');
    		$consulta_insert->execute(array(
    			':nombre'=>$nombre,
    			':apellidos'=>$apellidos,
    			':servicio'=>$servicio,
    			':direccion'=>$direccion,
    			':correo'=>$correo,
    			':telefono'=>$telefono,
    			':estatus'=>$estatus
    		));
    		header('Location: solicitud_proyecto.php');
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
	<link rel="stylesheet" href="css/estilosmenus.css">
	<link rel="stylesheet" href="css/solicitud.css">
	<title>Nuevo Proyecto</title>
</head>
<body>
	<header>
        <div class="logo">
                <a href="#"><img src="../img/logo.png" width="150" alt=""></a>
                <a href="#">C-PRO ASOCIADOS</a>
            </div>
        <nav class="navegacion">
            <ul class="menu">
                <li><a href="../indexcliente.php">Inicio</a></li>
                <li><a href="#">Solicitudes</a>
                    <ul class="submenu">
                        <li><a href="informacion.php">Información</a></li>
                        <li><a href="solicitud_proyecto.php">Proyecto</a></li>
                    </ul>
                </li>
                <li><a href="servicios.html">Servicios</a></li>
                <li><a href="proyectos.php">Proyectos</a>
                </li>
                <li><a href="login_usuario.php">Iniciar Sesión</a>
                     <ul class="submenu">
                        <li><a href="../cerrar_sesion.php">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
	<div class="container">
		<h2>Solicitud para un Proyecto</h2>
		<form action="" method="post">
			<div class="form-group">
    		  <input type="text" name="nombre" placeholder="Nombre del Solicitante" class="input_text">
    	    </div>
    	    <div class="form-group">
    		  <input type="text" name="apellidos" placeholder="Apellidos del Solicitante" class="input_text">
    	    </div>
    	    <div class="form-group">
    		  <input type="text" name="servicio" placeholder="Servico requerido del Solicitante" class="input_text">
    	    </div>
    	    <div class="form-group">
    		  <input type="text" name="direccion" placeholder="Dirección donde se requiere el Servicio" class="input_text">
    	    </div>
    	     <div class="form-group">
    		  <input type="text" name="correo" placeholder="Correo del Solicitante" class="input_text">
    	    </div>
    	    <div class="form-group">
    		  <input type="tel" name="telefono" placeholder="Telefono del Solicitante" class="input_text">
    	    </div>
    	    <div class="form-group">
    		  <input type="text" name="estatus" placeholder="Estatus de la Solicitud" class="input_text">
    	    </div>
    	    <div class="btn__group">
                <a href="solicitud_proyecto.php" class="btn btn__danger">Cancelar</a>
                <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
        </div>
		</form>
	</div>
</body>
</html>