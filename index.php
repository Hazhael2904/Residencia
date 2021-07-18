<?php
include_once 'conexion.php';
session_start();
$varsesion = $_SESSION['usuario'];
if(!isset($_SESSION['usuario'])){
	echo'
          <script>
             alert("Por Favor Inicia Sesión");
              window.location = "login_usuario.php";
          </script>    
	';
	die();
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilos.css">
	<title>C-PRO ASOCIADOS</title>
</head>
<body> 
	<header>
		<div class="logo">
				<a href="#"><img src="img/logo.png" width="150" alt=""></a>
				<a href="#">C-PRO ASOCIADOS</a>
                
			</div>
		<nav class="navegacion">
			<ul class="menu">
				<li><a href="index.php">Inicio</a>
				</li>
				<li><a href="#">Solicitudes</a>
                    <ul class="submenu">
                    	<li><a href="Administrador/informacion.php">Información</a></li>
                    	<li><a href="Administrador/solicitud_proyecto.php">Proyecto</a></li>
                    </ul>
				</li>
				<li><a href="Administrador/servicios.html">Servicios</a></li>
				<li><a href="Administrador/proyectos.php">Proyectos</a>
				</li>
				<li><a href="Administrador/indexcalend.html">Calendario</a>
					<ul class="submenu">
						<li><a href="Administrador/cita.php">Citas</a></li>
					</ul>
				</li>
				<li><a href="#">Usuarios</a>
                    <ul class="submenu">
                    	<li><a href="Administrador/usuarios.php">Usuarios</a></li>
                    	<li><a href="Administrador/personal.php">Personal</a></li>
                    	<li><a href="Administrador/clientes.php">Clientes</a></li>
                    </ul>
				</li>
				<li><a href="login_usuario.php">Iniciar Sesión</a>
                    <ul class="submenu">
                    	<li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
                    </ul>
				</li>
			</ul>
		</nav>
	</header>
</body>
</html>
