<?php
    include_once 'conexion.php';
    $sentencia_select=$con->prepare('SELECT *FROM solicitud_info ORDER BY id DESC');
    $sentencia_select->execute();
    $resultado=$sentencia_select->fetchAll();

    // metodo buscar
if (isset($_POST['btn_buscar'])) {
	$buscar_text=$_POST['buscar'];
	$select_buscar=$con->prepare('
		SELECT *FROM solicitud_info WHERE nombre LIKE :campo OR apellidos LIKE :campo;'
	);

	$select_buscar->execute(array(
		':campo' =>"%".$buscar_text."%"
	));

	$resultado=$select_buscar->fetchAll();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilos.css">
	<link rel="stylesheet" href="css/info.css">
	<title>Solicitudes de Información</title>
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
	<div class="contenedor">
		<h2>Tabla de Solicitudes de Información</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar nombre o apellidos" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insertsolicitud_info.php" class="btn btn__nuevo">Nuevo</a>
			</form>
			<table>
				<tr class="head">
					
					<td>Nombre</td>
					<td>Apellidos</td>
					<td>Tipo</td>
					<td>Telefono</td>
					<td>Correo</td>
					<td>Estatus</td>
					<td colspan="2">Acción</td>
				</tr>
				<?php foreach($resultado as $fila):?>
				<tr>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['apellidos']; ?></td>
					<td><?php echo $fila['tipo']; ?></td>
					<td><?php echo $fila['telefono']; ?></td>
					<td><?php echo $fila['correo']; ?></td>
					<td><?php echo $fila['estatus']; ?></td>
					<td><a href="updateinfo.php?id=<?php
					echo $fila['id']; ?>" class="btn btn_update">Editar</a></td>
					<td><a href="deletesolicitud.php?id=<?php
					echo $fila['id']; ?>" class="btn btn_delete">Eliminar</a></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</body>
</html>