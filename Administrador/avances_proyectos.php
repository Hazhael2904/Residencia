<?php
    include_once 'conexion.php';
    $sentencia_select=$con->prepare('SELECT * FROM avances_proyectos ORDER BY idavances DESC');
    $sentencia_select->execute();
    $resultado=$sentencia_select->fetchAll();


    //metodo buscar
    if(isset($_POST['btn_buscar'])){
    	$buscar_text=$_POST['buscar'];
    	$select_buscar=$con->prepare('
    		SELECT * FROM avances_proyectos WHERE fecharegistro LIKE :campo OR idcliente LIKE :campo;');
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
	<link rel="stylesheet" href="css/personalestilos.css">
	<title>Avances de Proyectos</title>
	<link rel="stylesheet" href="css/estilos4.css">
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
		<div class="barra__buscador">
		   <form action="" class="formulario" method="post">
			 <input type="text" name="buscar" placeholder="Buscar" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
			 <input type="submit" class="btn" name="btn_buscar" value="Buscar">
		   </form>
        </div>
        <table>
        	<tr class="head">
        		<td>Observaciones</td>
        		<td>Fecha de Registro</td>
        		<td>Nombre del Proyecto</td>
        		<td>Nombre del Cliente</td>
        		<td>Nombre del Personal</td>
        		<td colspan="3">Acciones</td>
        	</tr>
        	<?php 

        	$query = "SELECT  avances.observaciones, avances.fecharegistro,
        	CONCAT(proyecto.nombre,' ', proyecto.descripcion) as nombreproyecto,
        	CONCAT(cliente.nombre,' ' ,cliente.apellido1,' ' ,cliente.apellido2) as nombrecliente,
        	CONCAT(personal.nombre, ' ', personal.apellidopat, ' ', personal.apellidomat) as nombrepersonal
        	FROM avances_proyectos avances
        	INNER JOIN proyectos proyecto ON avances.idproyectos = proyecto.idproyectos
        	INNER JOIN cliente cliente ON avances.idcliente = cliente.idcliente
        	INNER JOIN personal personal ON avances.idpersonal = personal.idpersonal";

        	if( !$consulta=$con->query($query) ){

        	}else{
        		while($fila=$consulta->fetch(PDO::FETCH_ASSOC)){
             
             ?>

                 <tr>
                 	<td><?php echo $fila['observaciones']; ?></td>
                 	<td><?php echo $fila['fecharegistro']; ?></td>
                 	<td><?php echo $fila['nombreproyecto']; ?></td>
                 	<td><?php echo $fila['nombrecliente']; ?></td>
                 	<td><?php echo $fila['nombrepersonal']; ?></td>
                 	<td><a href="updateavance.php?idavances=<?php echo $fila['idavances'];?>" class="btn btn_update">Editar</a></td>
                 	<td><a href="deleteavance.php?idavances=<?php echo $fila['idavances'];?>" class="btn btn_delete">Eliminar</a></td>
                    <td><a href="evidencias.php">Evidencias</a></td>
                 </tr>
                <?php

        		}
        	}
        	?>
        </table>
	</div>
</body>
</html>