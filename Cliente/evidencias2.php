<?php
$con = new mysqli("localhost","root","","constructora");

$msg = '';

if(isset($_POST['upload'])){
	$image = $_FILES['image']['name'];
	$path = 'evidencia2/'.$image;

	$sql = $con->query("INSERT INTO imagenes (image_path) VALUES ('$path')");


	if($sql){
		move_uploaded_file($_FILES['image']['tmp_name'], $path);
		$msg = 'Imagen Cargada con exito!!';
	}
	else{
		$msg = 'Imagen no cargada error!!';
	}
}

$result = $con->query("SELECT image_path from imagenes");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Diseños</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
	<h2 class="text-center bg-dark text-light pb-2">Muestra de Diseños 3D</h2>

		<div class="container-fluid">
       <div class="row justify-content-center mb-2">
       	<div class="col-lg-10">
       		<div id="demo" class="carousel slide" data-ride="carousel">

       			<!-- Indicators -->
       			<ul class="carousel-indicators">

       				<?php 
                       $i = 0;
                       foreach ($result as $row){
                       	$actives = '';

                       	if($i == 0){
                       		$actives = 'active';
                       	}
                       
       				?>
       				<li data-target="#demo" data-slide-to="<?= $i ?>" class="<?= $actives; ?>"></li>

       				<?php $i++; } ?>
       			</ul>

       			<!-- The slideshow -->
       			<div class="carousel-inner">
       				<?php 
                       $i = 0;
                       foreach ($result as $row){
                       	$actives = '';

                       	if($i == 0){
                       		$actives = 'active';
                       	}
                       
       				?>
       				<div class="carousel-item <?= $actives; ?>">
       					<img src="<?= $row['image_path'] ?>" width="100%" heigth="400">
       				</div>
       				
                    <?php $i++; }?>

       			</div>

       			<!-- Left and right controls -->
       			<a class="carousel-control-prev" href="#demo" data-slide="prev">
       				<span class="carousel-control-prev-icon"></span>
       			</a>
       			<a class="carousel-control-next" href="#demo" data-slide="next">
       				<span class="carousel-control-next-icon"></span>
       			</a>

       		</div>
       	</div>
       </div>

		<div class="row justify-content-center">
			<div class="col-lg-4 bg-dark rounded px-4">
				<h4 class="text-center text-light p-1">Selecciona la Imagen</h4>
				<form action="" method="post" enctype="multipart/form-data">
				 <div class="form-group">
				 	<input type="file" name="image" class="form-control p-1" required>
				 </div>
				 <div class="form-group">
				 	<input type="submit" name="upload" class="btn btn-warning" value="Cargar Imagen">
				 </div>
				 <div class="form-group">
				 	<h5 class="text-center text-light"><?= $msg; ?></h5>
				 </div>
				</form>
			</div>
		</div>
	</div>















	<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>