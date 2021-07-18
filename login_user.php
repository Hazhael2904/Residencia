<?php
    
    session_start();
    include 'conexion2.php';

    $email=$_POST['email'];
    $password=$_POST['password'];
    $password= hash('sha512', $password);

    $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email='$email' and password='$password' ");

    if(mysqli_num_rows($query) > 0){
      $_SESSION['usuario'] = $email;
      header("location:index.php");
      exit;
    }else{
      echo' <script> 
      alert("Usuario no existe");
        window.location = "login_usuario.php";

        </script>
        ';
        exit;
    }

?>