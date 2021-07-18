<?php
    include_once 'conexion.php';
    $sentencia_select=$con->prepare('SELECT * FROM citas ORDER BY id_citas DESC');
    $sentencia_select->execute();
    $resultado=$sentencia_select->fetchAll();

     //metodo buscar
    if(isset($_POST['btn_buscar'])){
    	$buscar_text=$_POST['buscar'];
    	$select_buscar=$con->prepare('
    		SELECT * FROM citas WHERE asunto LIKE :campo OR idservicio LIKE :campo;');
    	$select_buscar->execute(array(
    		':campo' =>"%".$buscar_text."%"));
    	$resultado=$select_buscar->fetchAll();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/personalestilos.css">
	<title>Citas</title>
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
	<div class="contenedor">
		<h2>Citas en Proceso</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="POST">
				<input type="text" name="buscar" placeholder="Buscar Asunto o Servicio" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insertcita.php" class="btn btn__nuevo">Nuevo</a>
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Asunto</td>
				<td>Observaciones</td>
				<td>Estatus</td>
				<td>Fecha de Registro</td>
				<td>Fecha de Programación</td>
				<td>Usuario</td>
				<td>Personal</td>
				<td>Servicio</td>
				<td colspan="2">Acción</td>
			</tr>
             
             <?php 
                  $query="SELECT cita.asunto, cita.observaciones, cita.estatus, cita.fecharegistro, cita.fechaprogramacion,
                  CONCAT(cliente.nombre, ' ', cliente.apellido1, ' ',cliente.apellido2) as nombrecliente,
                  CONCAT(personal.nombre, ' ', personal.apellidopat, ' ',personal.apellidomat) as nombrepersonal,
                  servicio.nombre as nombreservicio
                  FROM citas cita
                  INNER JOIN cliente cliente ON cita.idcliente = cliente.idcliente
                  INNER JOIN personal personal ON cita.idpersonal = personal.idpersonal
                  INNER JOIN servicio servicio ON cita.idservicio = servicio.idservicio";
             if( !$consulta=$con->query($query) ){

             }else{
             	while ($fila=$consulta->fetch(PDO::FETCH_ASSOC))
             	{

             	?>
             	<tr>
             		<td><?php echo $fila['asunto'];?></td>
             		<td><?php echo $fila['observaciones'];?></td>
             		<td><?php echo $fila['estatus'];?></td>
             		<td><?php echo $fila['fecharegistro'];?></td>
             		<td><?php echo $fila['fechaprogramacion'];?></td>
             		<td><?php echo $fila['nombrecliente'];?></td>
             		<td><?php echo $fila['nombrepersonal'];?></td>
             		<td><?php echo $fila['nombreservicio'];?></td>
             		<td><a href="updatecita.php?id_citas=<?php echo $fila['id_citas'];?>" class="btn btn_update">Editar</a></td>
				    <td><a href="delete.php?id_citas=<?php echo $fila['id_citas']; ?>" class="btn btn_delete">Eliminar</a></td>
				    
                 </tr>
                 </tr>
             	</tr>	
                <?php
             	}
             }

             ?>
		</table>
	</div>
</body>
</html>