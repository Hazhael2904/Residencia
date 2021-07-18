<?php
    include_once 'conexion.php';

   if(isset($_POST['guardar'])){
    	$id=$_POST['idproyectos'];
    	$nombre=$_POST['nombre'];
    	$descripcion=$_POST['descripcion'];
    	$idcliente=$_POST['idcliente'];
    	$FechRegistro=$_POST['FechRegistro'];
    	$Estatus=$_POST['Estatus'];
    	$idservicio=$_POST['idservicio'];
    	$idpersonal=$_POST['idpersonal'];

    	if(!empty($nombre) && !empty($descripcion) && !empty($idcliente) && !empty($FechRegistro) && !empty($Estatus) && !empty($idservicio) && !empty($idpersonal)){
    		
    			$consulta_update=$con->prepare('UPDATE proyectos SET 
    				nombre=:nombre,
    				descripcion=:descripcion,
    				idcliente=:idcliente,
    				FechRegistro=:FechRegistro,
    				Estatus=:Estatus,
    				idservicio=:idservicio,
    				idpersonal=:idpersonal
    				WHERE idproyectos=:idproyectos;'
    			);
    			$result=
    			$consulta_update->execute(array(
    				':nombre' =>$nombre,
    			    ':descripcion' =>$descripcion,
    			    ':idcliente' =>$idcliente,
    			    ':FechRegistro' =>$FechRegistro,
    			    ':Estatus' =>$Estatus,
    			    ':idservicio' =>$idservicio,
    			    ':idpersonal' =>$idpersonal,
    			    ':idproyectos'=>$id
    			));
    			header('Location: proyectos.php');
    			
    		
    	}else{
    		echo var_dump($id,$nombre,$descripcion,$idcliente,$FechRegistro,$Estatus,$idservicio,$idpersonal);
    		
    		echo "<script> alert('Los campos estan vacios');</script>";
    	}
    }

    if(isset($_GET['idproyectos'])){
    	$id=(int) $_GET['idproyectos'];

    	$buscar_id=$con->prepare('SELECT * FROM proyectos WHERE idproyectos=:idproyectos LIMIT 1');

    	$buscar_id->execute(array(
    		':idproyectos'=>$id
    	));
    	$resultado=$buscar_id->fetch();
    }else{
    	header('Location: proyectos.php');
    }
      
 $queryclientes=("SELECT CONCAT(nombre, ' ', apellido1, ' ', apellido2) nombrecliente, idcliente FROM cliente");
 $clientes=$con->query($queryclientes);
 $queryservicios=("SELECT CONCAT(nombre) nombreservicio, idservicio FROM servicio");
 $servicios=$con->query($queryservicios);
  $querypersonall=("SELECT CONCAT(nombre, ' ', apellidopat, ' ', apellidomat) nombrepersonal, idpersonal FROM personal");
 $personall=$con->query($querypersonall);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilosmenus.css">
	<link rel="stylesheet" href="css/solicitud.css">
	<title>Editar Proyecto</title>
</head>
<body>
	<header>
		<div class="logo">
				<a href="#"><img src="../img/logo.png" width="150" alt=""></a>
				<a href="#">C-PRO ASOCIADOS</a>
			</div>
		<nav class="navegacion">
			<ul class="menu">
				<li><a href="../index.php">Inicio</a>
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
	<div class="container">
		<h2>Información de Proyecto</h2>
		<form action="" method="POST">
			<input type="hidden" name="idproyectos" value="<?php echo($id);?>">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre'];?>" class="input_text">
			</div>
			<div class="form-group">
				<input type="text" name="descripcion" value="<?php if($resultado) echo $resultado['descripcion'];?>" class="input_text">
			</div>
			<div class="form-group">
				<select name="idcliente" id="">
						
							<?php
	                    while ($cliente=$clientes->fetch(PDO::FETCH_ASSOC)): ?>
                          <option value="<?php echo $cliente['idcliente'];?>" <?php echo (($cliente['idcliente']==$resultado['idcliente']) ? 'selected' : '');?>><?php echo $cliente['nombrecliente'];?></option>
                 
                             <?php endWhile;?>

                 </select>
			</div>
			<div class="form-group">
				<input type="date" name="FechRegistro" value="<?php if($resultado) echo $resultado['FechRegistro'];?>" class="input_text">
			</div>
			<div class="form-group">
				<select name="Estatus" id="">
					<option value="En_Proceso" <?php echo(($resultado['Estatus']=='En_Proceso')? 'selected':'');?> >En Proceso</option>
					<option value="Aceptado" <?php echo(($resultado['Estatus']=='Aceptado')? 'selected':'');?> >Aceptado</option>
					<option value="En_Desarrollo" <?php echo(($resultado['Estatus']=='En_Desarrollo')? 'selected':'');?> >En Desarrollo</option>
					<option value="Terminado" <?php echo(($resultado['Estatus']=='Terminado')? 'selected':'');?> >Terminado</option>
					</select>
			</div>
			<div class="form-group">
				<select name="idservicio" id="">
				<?php

	                    while ($servicio=$servicios->fetch(PDO::FETCH_ASSOC)): ?>
                          <option value="<?php echo $servicio['idservicio'];?>"  <?php echo (($servicio['idservicio']==$resultado['idservicio']) ? 'selected' : '');?>><?php echo $servicio['nombreservicio'];?></option>
                 
                             <?php endWhile;?>

                </select>			
                       </div>
			<div class="form-group">
				<select name="idpersonal" id="">
						
							<?php
	                    while ($personal=$personall->fetch(PDO::FETCH_ASSOC)): ?>
                          <option value="<?php echo $personal['idpersonal'];?>"  <?php echo (($personal['idpersonal']==$resultado['idpersonal']) ? 'selected' : '');?>><?php echo $personal['nombrepersonal'];?></option>
                 
                             <?php endWhile;?>

                           </select>
			</div>
			<div class="btn__group">
				<a href="proyectos.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>