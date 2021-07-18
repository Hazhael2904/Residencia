<?php
    include_once 'conexion.php';
    $sentencia_select=$con->prepare('SELECT * FROM proyectos ORDER BY idproyectos DESC');
    $sentencia_select->execute();
    $resultado=$sentencia_select->fetchAll();


    //metodo buscar
    if(isset($_POST['btn_buscar'])){
    	$buscar_text=$_POST['buscar'];
    	$select_buscar=$con->prepare('
    		SELECT * FROM proyectos WHERE nombre LIKE :campo OR Tipo LIKE :campo;');
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
	<title>Proyectos</title>
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
		<h2>PROYECTOS EN PROCESO</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar nombre o Tipo" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insertproyecto.php" class="btn btn__nuevo">Nuevo</a>
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Nombre</td>
				<td>Descripción</td>
				<td>Cliente</td>
				<td>Fecha de Registro</td>
				<td>Estatus</td>
				<td>idservicio</td>
				<td>Personal</td>
				<td colspan="3">Acción</td>
				
			</tr>

			<?php 
				 $query="SELECT proyecto.nombre, proyecto.descripcion,proyecto.FechRegistro, proyecto.Estatus,proyecto.idproyectos,
				         CONCAT(cliente.nombre, ' ', cliente.apellido1, ' ',cliente.apellido2) as nombrecliente,
				         CONCAT(personal.nombre, ' ', personal.apellidopat, ' ',personal.apellidomat) as nombrepersonal,
				         servicio.nombre as nombreservicio
                        FROM proyectos proyecto 
                        INNER JOIN cliente cliente ON proyecto.idcliente = cliente.idcliente
                        INNER JOIN personal personal ON proyecto.idpersonal = personal.idpersonal
                        INNER JOIN servicio servicio ON proyecto.idservicio = servicio.idservicio";
                 if ( !$consulta=$con->query($query) ){
                     
                 }else{
                 	while ($fila=$consulta->fetch(PDO::FETCH_ASSOC))
                {
                 	
                ?>
                  <tr>
                 
                 <td><?php echo $fila['nombre'];?></td>
                 <td><?php echo$fila['descripcion'];?></td>
                 <td><?php echo$fila['nombrecliente'];?></td>
                 <td><?php echo$fila['FechRegistro'];?></td>
                 <td><?php echo$fila['Estatus'];?></td>
                 <td><?php echo$fila['nombreservicio'];?></td>
                 <td><?php echo$fila['nombrepersonal'];?></td>
                 <td><a href="updateproyecto.php?idproyectos=<?php
					echo $fila['idproyectos']; ?>" class="btn btn_update">Editar</a></td>
				 <td><a href="delete.php?idproyectos=<?php
					echo $fila['idproyectos']; ?>" class="btn btn_delete">Eliminar</a></td>
					<td><a href="avances_proyectos.php" class="btn btn_avances">Avances</a></td>
                 </tr>
                 <?php
                 }
               
                 }
                
			?>
		</table>
	</div>
</body>
</html>