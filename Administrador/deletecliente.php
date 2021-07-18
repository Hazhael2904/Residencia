<?php
    include_once 'conexion.php';
    if(isset($_GET['idcliente'])){
    	$id=(int) $_GET['idpersonal'];
    	$delete=$con->prepare('DELETE FROM cliente WHERE idcliente=:idcliente');
    	$delete->execute(array(
    		':idcliente'=>$id 
    	));
    	header('Location: clientes.php');
    }else{
    	header('Location: clientes.php');
    }
?>