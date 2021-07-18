<?php
 $database="constructora";
  $user='root';
  $password='';
  $host='localhost';


try{

$con = new PDO('mysql:host=localhost;dbname='.$database,$user,$password);
}catch (PDOException $e){

	echo "Error".$e->getMessage();
}

?>