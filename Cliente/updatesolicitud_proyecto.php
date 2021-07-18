<?php
    include_once 'conexion.php';

    if(isset($_GET['id'])){
    	$id=(int) $_GET['id'];
    	$buscar_id=$con->prepare('SELECT * FROM solicitud_proyecto WHERE id=id LIMIT 1');
    	$buscar_id->execute(array(
    		':id' =>$id
    	));
    	$resultado=$buscar_id->fetch();
    }else{
    	header('Location: solicitud_proyecto.php');
    }

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
    			$consulta_update=$con->prepare('UPDATE solicitud_proyecto SET 
    				nombre=:nombre,
    				apellidos=:apellidos,
    				servicio=:servicio,
    				direccion=:direccion,
    				correo=:correo,
    				telefono=:telefono,
    				estatus=:estatus
    				WHERE id=:id;'
    			);

    			$consulta_update->execute(array(
    				':nombre'=>$nombre,
    				':apellidos'=>$apellidos,
    				':servicio'=>$servicio,
    				':direccion'=>$direccion,
    				':correo'=>$correo,
    				':telefono'=>$telefono,
    				':estatus'=>$estatus,
    				':id'=>$id
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
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/Solicitud.css">
	<title>Editar Solicitud</title>
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
		<h2>Solicitud para Solicitar un Proyecto</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado ['nombre'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="apellidos" value="<?php if($resultado) echo $resultado ['apellidos'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="servicio" value="<?php if($resultado) echo $resultado ['servicio'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="direccion" value="<?php if($resultado) echo $resultado ['direccion'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado ['correo'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="tel" name="telefono" value="<?php if($resultado) echo $resultado ['telefono'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="estatus" value="<?php if($resultado) echo $resultado ['estatus'];?>" class="input_text">
			</div>
			<div class="btn__group">
                <a href="solicitud_proyecto.php" class="btn btn__danger">Cancelar</a>
                <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
        </div>
		</form>
	</div>
</body>
</html>