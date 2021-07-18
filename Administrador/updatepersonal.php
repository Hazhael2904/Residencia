<?php 
    include_once 'conexion.php';

    if (isset($_GET['idpersonal'])) {
    	$id=(int) $_GET['idpersonal'];
        
        $buscar_id=$con->prepare('SELECT * FROM personal WHERE idpersonal=:idpersonal LIMIT 1');
        $buscar_id->execute(array(
        	':idpersonal'=>$id
        ));
    	$resultado=$buscar_id->fetch();
    }else{
    	header('Location: personal.php');
    }


    if(isset($_POST['guardar'])){
    	$nombre=$_POST['nombre'];
    	$apellidopat=$_POST['apellidopat'];
    	$apellidomat=$_POST['apellidomat'];
    	$domicilio=$_POST['domicilio'];
    	$telefono=$_POST['telefono'];
    	$correo=$_POST['correo'];
    	$puesto=$_POST['puesto'];
    	$fechareg=$_POST['fechareg'];
    	$estatus=$_POST['estatus'];
    	$idpersonal=(int) $_GET['idpersonal'];

    	if(!empty($nombre) && !empty($apellidopat) && !empty($apellidomat) && !empty($domicilio) && !empty($telefono) && !empty($correo) && !empty($puesto) && !empty($fechareg) && !empty($estatus) ){

    		if(!filter_var($correo,
    			FILTER_VALIDATE_EMAIL)){
    			echo"<script> alert('Correo no valido');</script>";
    		}else{
    			$consulta_update=$con->prepare(' UPDATE personal SET 
    				nombre=:nombre,
    				apellidopat=:apellidopat,
    				apellidomat=:apellidomat,
    				domicilio=:domicilio,
    				telefono=:telefono,
    				correo=:correo,
    				puesto=:puesto,
    				fechareg=:fechareg,
    				estatus=:estatus
    				WHERE idpersonal=:idpersonal;'
    			);
    			$consulta_update->execute(array(
    				':nombre' =>$nombre,
    				':apellidopat' =>$apellidopat,
    				':apellidomat' =>$apellidomat,
    				':domicilio' =>$domicilio,
    				':telefono' =>$telefono,
    				':correo' =>$correo,
    				':fechareg' =>$fechareg,
    				':estatus' =>$estatus,
    				':idpersonal' =>$id
    			));
    			header('Location: personal.php');
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
	<title>Editar Personal</title>
	<link rel="stylesheet" href="css/solicitud.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <div class="logo">
                <a href="#"><img src="../img/logo.png" width="150" alt=""></a>
                <a href="#">C-PRO ASOCIADOS</a>
            </div>
        <nav class="navegacion">
            <ul class="menu">
                <li><a href="../index.php">Inicio</a></li>
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
                        <li><a href="cliente.php">Clientes</a></li>
                    </ul>
                </li>
                <li><a href="login_usuario.php">Iniciar Sesión</a>
                    <ul class="submenu">
                        <li><a href="../cerrar_sesion">Cerrar Sesión</a></li>
                    </ul>
                
                </li>
            </ul>
        </nav>
    </header>
	<div class="contenedor">
		<h2>Editar Personal</h2>
		<form action="personal.php" method="post">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="apellidopat" value="<?php if($resultado) echo $resultado['apellidopat'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="apellidomat" value="<?php if($resultado) echo $resultado['apellidomat'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="domicilio" value="<?php if($resultado) echo $resultado['domicilio'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="telefono" value="<?php if($resultado) echo $resultado['telefono'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="puesto" value="<?php if($resultado) echo $resultado['puesto'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="fechareg" value="<?php if($resultado) echo $resultado['fechareg'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="estatus" value="<?php if($resultado) echo $resultado['estatus'];?>" class="input_text">
			</div>
			<div class="btn__group">
				<a href="personal.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
