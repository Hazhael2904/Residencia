<?php
    include_once 'conexion.php';

    if(isset($_GET['id'])){
    	$id=(int) $_GET['id'];

    	$buscar_id=$con->prepare('SELECT * FROM solicitud_info WHERE id=id LIMIT 1');
    	$buscar_id->execute(array(
    		':id'=>$id
    	));
    	$resultado=$buscar_id->fetch();
    }else{
    	header('Location: informacion.php');
    }

    if(isset($_POST['guardar'])){
    	$nombre=$_POST['nombre'];
    	$apellidos=$_POST['apellidos'];
    	$tipo=$_POST['tipo'];
    	$telefono=$_POST['telefono'];
    	$correo=$_POST['correo'];
    	$estatus=$_POST['estatus'];

    	if(!empty($nombre) && !empty($apellidos) && !empty($tipo) && !empty($telefono) && !empty($correo) && !empty($estatus) ){

    		if(!filter_var($correo,
    			FILTER_VALIDATE_EMAIL)){
    			echo"<script> alert('Correo no valido');</script>";
    		}else{
    			$consulta_update=$con->prepare('UPDATE solicitud_info SET
    				nombre=:nombre,
    				apellidos=:apellidos,
    				tipo=:tipo,
    				telefono=:telefono,
    				correo=:correo,
    				estatus=:estatus
    				WHERE id=:id;'
    			);

                $consulta_update->execute(array(
                    ':nombre'=>$nombre,
                    ':apellidos'=>$apellidos,
                    ':tipo'=>$tipo,
                    ':telefono'=>$telefono,
                    ':correo'=>$correo,
                    ':estatus'=>$estatus,
                    ':id'=>$id
                ));
                header('Location: informacion.php');
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
                <li><a href="indexcliente.php">Inicio</a></li>
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
        <h2>Solicitud de Información de Servicios</h2>
        <form action="" method="post">
        <div class="form-group">
            <input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre'];?>"class="input_text">
        </div>
        <div class="form-group">
            <input type="text" name="apellidos" value="<?php if($resultado) echo $resultado['apellidos'];?>" class="input_text">
        </div>
        <div class="form-group">
            <input type="text" name="tipo" value="<?php if($resultado) echo $resultado['tipo'];?>" class="input_text">
        </div>
        <div class="form-group">
            <input type="tel" name="telefono" value="<?php if($resultado) echo $resultado['telefono'];?>" class="input_text">
        </div>
        <div class="form-group">
            <input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo'];?>" class="input_text">
        </div>
        <div class="form-group">
            <input type="text" name="estatus" value="<?php if($resultado) echo $resultado['estatus'];?>" class="input_text">
        </div>
        <div class="btn__group">
                <a href="informacion.php" class="btn btn__danger">Cancelar</a>
                <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
        </div>

        </form>
    </div>
</body>
</html>