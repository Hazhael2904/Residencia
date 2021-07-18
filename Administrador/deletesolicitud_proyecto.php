<?php
    include_once 'conexion.php';
    if(isset($_GET['id'])){
    	$id=(int) $_GET['id'];
    	$delete=$con->prepare('DELETE FROM solicitud_proyecto WHERE id=:id');
    	$delete->execute(array(
    		':id'=>$id 
    	));
    	header('Location: solicitud_proyecto.php');
    }else{
    	header('Location: solicitud_proyecto.php');
    }
?>