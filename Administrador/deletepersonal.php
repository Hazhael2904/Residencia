<?php
    include_once 'conexion.php';
    if(isset($_GET['idpersonal'])){
    	$id=(int) $_GET['idpersonal'];
    	$delete=$con->prepare('DELETE FROM personal WHERE idpersonal=:idpersonal');
    	$delete->execute(array(
    		':idpersonal'=>$id 
    	));
    	header('Location: personal.php');
    }else{
    	header('Location: personal.php');
    }
?>