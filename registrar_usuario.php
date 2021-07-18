<?php
include_once 'conexion2.php';
$nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $email=$_POST['email'];
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];
    $fecharegistro=$_POST['fecharegistro'];
    $estatus=$_POST['estatus'];
    $idrol=$_POST['idrol'];


    //encriptar contraseña
    $password= hash('sha512', $password);
    $queryconsulta = "SELECT usuario.nombre, usuario.apelidos, usuario.email, usuario.usuario, usuario.password, usuario.fecharegistro, usuario.estatus, usuario.idrol, 
      rol.descripcion as nombrerol
      FROM usuarios usuario
      INNER JOIN roles rol ON usuario.idrol = rol.idrol";

    $query = "INSERT INTO usuarios(nombre,apellidos,email,usuario,password,fecharegistro,estatus,idrol) VALUES('$nombre', '$apellidos', '$email', '$usuario', '$password', '$fecharegistro', '$estatus', '$idrol')";

    $ejecutar = mysqli_query($conexion, $query);

     if($ejecutar){
        echo'
        <script>
             alert("Usuario registrado exitosamnete");
             window.location = "login_usuario.php";
        </script>
        ';
    }else{
        echo'
        <script>
             alert("Intentelo de nuevo, usuario no almacenado");
             window.location = "../registar_usuario.php";
        </script>
        ';
    }

    mysqli_close($conexion);

?>

?>
