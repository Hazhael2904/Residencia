<?php
include_once 'conexion.php';

  if(isset($_POST['guardar'])){
	$id=$_POST['id_citas'];
	$asunto=$_POST['asunto'];
	$observaciones=$_POST['observaciones'];
	$estatus=$_POST['estatus'];
	$fecharegistro=$_POST['fecharegistro'];
	$fechaprogramacion=$_POST['fechaprogramacion'];
	$idcliente=$_POST['idcliente'];
	$idpersonal=$_POST['idpersonal'];
	$idservicio=$_POST['idservicio'];

  if(!empty($asunto) && !empty($observaciones) && !empty($estatus) && !empty($fecharegistro) && !empty($fechaprogramacion) && !empty($idcliente) && !empty($idpersonal) && !empty($idservicio)){
      

      $consulta_update=$con->prepare('UPDATE citas SET 
      	asunto=:asunto,
      	observaciones=:observaciones,
      	estatus=:estatus,
      	fecharegistro=:fecharegistro.
      	fechaprogramacion=:fechaprogramacion,
      	idcliente=:idcliente,
      	idpersonal=:idpersonal,
      	idservicio=:idservicio;
      	');
      $consulta_update->execute(array(
            ':asunto'=>$asunto,
			':observaciones'=>$observaciones,
			':estatus'=>$estatus,
			':fecharegistro'=>$fecharegistro,
			':fechaprogramacion'=>$fechaprogramacion,
			':idcliente'=>$idcliente,
			':idpersonal'=>$idpersonal,
			':idservicio'=>$idservicio,
			':id_citas'=>$id
		));
      header('Location: citas.php');
    }else{
    	echo "<script> alert('Los campos estan vacios');</script>";
    }
}

if(isset($_GET['idcita'])){
	$id=(int) $_GET['idcita'];

	$buscar_id=$con->prepare('SELECT * FROM citas WHERE id_citas=:id_citas LIMIT 1');
	$buscar_id->execute(array(
		':id_citas' =>$id
	));
	$resultado=$buscar_id->fetch();
}else{
	header('Location: citas.php');
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
 		<link rel="stylesheet" href="css/estilos">
 		<link rel="stylesheet" href="css/solicitud.css">
 		<title>Actualizar Cita</title>
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
						<li><a href="citas.php">Citas</a></li>
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
		<form action="" method="POST">
			<input type="hidden" name="idcita" value="<?php echo($id);?>">
			<div class="form-group">
				<input type="text" name="asunto" value="<?php if($resultado) echo $resultado['asunto'];?>" class="input_text">
			</div>
			<div class="form-group">
					<textarea name="observaciones" cols="100" rows="5" placeholder="Observaciones a tratar." value="<?php if($resultado) echo $resultado['observaciones'];?>"></textarea>
			</div>
			<div class="form-group">
				<select name="estatus" id="">
					<option value="Aceptada" <?php echo(($resultado['estatus']=='Aceptada')? 'selected':'');?> >Aceptada</option>
					<option value="Rechazada" <?php echo(($resultado['estatus']=='Rechazada')? 'selected':'');?> >Rechazada</option>
					<option value="Reprogramada" <?php echo(($resultado['estatus']=='Reprogramada')? 'selected':'');?> >Reprogramada</option>
					<option value="En_Espera" <?php echo(($resultado['estatus']=='En_Espera')? 'selected':'');?> >En Espera</option>
					</select>
			</div>
			<div class="form-group">
				<input type="date" name="fecharegistro" value="<?php if($resultado) echo $resultado['fechaprogramacion'];?>" class="input_text">
			</div>
            <div class="form-group">
				<input type="date" name="fechaprogramacion" value="<?php if($resultado) echo $resultado['fechaprogramacion'];?>" class="input_text">
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
				<select name="idpersonal" id="">
						
							<?php
	                    while ($personal=$personall->fetch(PDO::FETCH_ASSOC)): ?>
                          <option value="<?php echo $personal['idpersonal'];?>"  <?php echo (($personal['idpersonal']==$resultado['idpersonal']) ? 'selected' : '');?>><?php echo $personal['nombrepersonal'];?></option>
                 
                             <?php endWhile;?>

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
            <div class="btn__group">
				<a href="cita.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
 	</body>
 	</html>	