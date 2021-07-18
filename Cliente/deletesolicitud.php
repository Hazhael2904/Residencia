<?php
    include_once 'conexion.php';
    if(isset($_GET['id'])){
    	$id=(int) $_GET['id'];
    	$delete=$con->prepare('DELETE FROM solicitud_info WHERE id=:id');
    	$delete->execute(array(
    		':id'=>$id 
    	));
    	header('Location: informacion.php');
    }else{
    	header('Location: informacion.php');
    }
?>