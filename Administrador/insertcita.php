<?php
include_once 'conexion.php';

if(isset($_POST['guardar'])){
	$asunto=$_POST['asunto'];
	$observaciones=$_POST['observaciones'];
	$estatus=$_POST['estatus'];
	$fecharegistro=$_POST['fecharegistro'];
	$fechaprogramacion=$_POST['fechaprogramacion'];
	$idcliente=$_POST['idcliente'];
	$idpersonal=$_POST['idpersonal'];
	$idservicio=$_POST['idservicio'];

	if(!empty($asunto) && !empty($observaciones) && !empty($estatus) && !empty($fecharegistro) && !empty($fechaprogramacion) && !empty($idcliente) && !empty($idpersonal) && !empty($idservicio)){

		$consulta_insert=$con->prepare('INSERT INTO citas(asunto,observaciones,estatus,fecharegistro,fechaprogramacion,idcliente,idpersonal,idservicio) VALUES (:asunto,:observaciones,:estatus,:fecharegistro,:fechaprogramacion,:idcliente,:idpersonal,:idservicio)');
		
		$consulta_insert->execute(array(
			':asunto'=>$asunto,
			':observaciones'=>$observaciones,
			':estatus'=>$estatus,
			':fecharegistro'=>$fecharegistro,
			':fechaprogramacion'=>$fechaprogramacion,
			':idcliente'=>$idcliente,
			':idpersonal'=>$idpersonal,
			':idservicio'=>$idservicio
		));
		header('Location: citas.php');
	}else{
		
		echo "<script> alert('Los campos estan vacios');</script>";
	}
}

$queryclientes=("SELECT CONCAT(nombre, ' ', apellido1, ' ', apellido2) nombrecliente, idcliente FROM cliente");
 $clientes=$con->query($queryclientes);

$querypersonall=("SELECT CONCAT(nombre, ' ', apellidopat, ' ', apellidomat) nombrepersonal, idpersonal FROM personal");
$personall=$con->query($querypersonall);

$queryservicios=("SELECT CONCAT(nombre) nombreservicio, idservicio FROM servicio");
$servicios=$con->query($queryservicios);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilosmenus.css">
	<link rel="stylesheet" href="css/solicitud.css">
	<title>Insertar Nueva Cita</title>
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
	<div class="container">
		<h2>Nueva Cita</h2>
		<div class="row text-center col-sn-12 col-nd-12 col-lg-12 py-4" >
			<form action="" method="post">
				<div class="form-group">
					<input type="text" name="asunto" placeholder="¿Asunto que decea tratar?" class="input_text">
				</div>
				<div class="form-group">
					<textarea name="observaciones" id="observaciones" cols="100" rows="5" placeholder="Observaciones a tratar."></textarea>
				</div>
				<div class="form-group">
					<select name="estatus" id="">
					<option value="Cita_Aprobada">Aceptada</option>
					<option value="Cita_Rechazada">Rechazada</option>
					<option value="Cita_Reprogramada">Reprogramada</option>
					<option value="Cita_en_Espera">En Espera</option>		
					</select>
				</div>
				<div class="form-group">
					<input type="date" name="fecharegistro" class="input_text">
				</div>
				<br>
				<div class="form-group">
					<input type="date" name="fechaprogramacion" class="input_text">
				</div>
				<br>
				<div class="form-goup">
					<label>Lista de Clientes</label>
					<select name="idcliente" id="">
						<?php
	                    while ($cliente=$clientes->fetch(PDO::FETCH_ASSOC)): ?>
                          <option value="<?php echo $cliente['idcliente'];?>"><?php echo $cliente['nombrecliente'];?></option>
                 
                             <?php endWhile;?>
					</select>
				</div>
				<div class="form-group">
					<label>Lista de Personal:</label>
					<select name="idpersonal" id="">
						
							<?php
	                    while ($personal=$personall->fetch(PDO::FETCH_ASSOC)): ?>
                          <option value="<?php echo $personal['idpersonal'];?>"><?php echo $personal['nombrepersonal'];?></option>
                 
                             <?php endWhile;?>

                           </select>
				</div>
				<div class="form-group">
					<label>Lista de Servicios:</label>
					<select name="idservicio" id="">
						
							<?php
	                    while ($servicio=$servicios->fetch(PDO::FETCH_ASSOC)): ?>
                          <option value="<?php echo $servicio['idservicio'];?>"><?php echo $servicio['nombreservicio'];?></option>
                 
                             <?php endWhile;?>

                           </select>
				</div>
				<div class="btn__group">
                <a href="cita.php" class="btn btn__danger">Cancelar</a>
                <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
            </div>
			</form>
		</div>
	</div>
</body>
</html>