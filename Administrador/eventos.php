<?php
header('Content-Type: application/json');
$pdo=new PDO('mysql:host=127.0.0.1;dbname=constructora;charset=UTF8','root',"");

$accion= (isset($_GET['accion']))?$_GET['accion']:'leer';

switch ($accion) {
	case 'agregar':
		//Introduccion de agregado
	$sentanciaSQL = $pdo->prepare("INSERT INTO
		eventos(title,descripcion,color,textColor,start,end)
		VALUES(:title,:descripcion,:color,:textColor,:start,:end)");


	$respuesta=$sentanciaSQL->execute(array(
          "title" =>$_POST['title'],
          "descripcion" =>$_POST['descripcion'],
          "color" =>$_POST['color'],
          "textColor" =>$_POST['textColor'],
           "start" =>$_POST['start'],
            "end" =>$_POST['end']
    ));

	echo json_encode($respuesta);

		break;
	case 'eliminar':
        $respuesta=false;
          
          if(isset($_POST['id'])){


          	 $sentanciaSQL=$pdo->prepare("DELETE FROM eventos WHERE id=:id");
          	 $respuesta= $sentanciaSQL->execute(array("id"=>$_POST['id']));

          }
	    echo json_encode($respuesta);
	      break;
	case 'modificar':

     $sentanciaSQL = $pdo->prepare("UPDATE eventos SET
          title=:title,
          descripcion=:descripcion,
          color=:color,
          textColor=:textColor,
          start=:start,
          end=:end
          WHERE ID=:ID
     	  ");

	$respuesta=$sentanciaSQL->execute(array(
		  "ID" =>$_POST['id'],
          "title" =>$_POST['title'],
          "descripcion" =>$_POST['descripcion'],
          "color" =>$_POST['color'],
          "textColor" =>$_POST['textColor'],
           "start" =>$_POST['start'],
            "end" =>$_POST['end']
    ));
    echo json_encode($respuesta);
	      break;
	default:
		//Seleccionar los eventos del calendario
           $sentanciaSQL= $pdo->prepare("SELECT * FROM eventos");
           $sentanciaSQL->execute();
           $resultado= $sentanciaSQL->fetchAll(PDO::FETCH_ASSOC);
           echo json_encode($resultado);
		break;
}


?>