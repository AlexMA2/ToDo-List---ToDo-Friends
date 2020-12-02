<?php
require "conexion.php";

if(isset($_POST["logearte"])){
  try{
    session_start();

    $usuario= htmlentities(addslashes($_POST['user']));
    $contrasena=htmlentities(addslashes($_POST['pass']));
    $contrasena_encriptada = sha1($contrasena);        

    $consulta="SELECT * FROM `usuarios` where `correo`= :user and `password`= :pass";
    $resultado = $conection->prepare($consulta);

    $resultado->bindValue(":user", $usuario);
    $resultado->bindValue(":pass", $contrasena_encriptada);

    $resultado->execute();

    $filas = $resultado->rowCount();

    if($filas == 1){      

      $rpta = $resultado->fetch(PDO::FETCH_ASSOC);     
      $_SESSION['user']=$rpta['iduser'];  
      header("location:NetWork.php");

    }else{      
      #se redirigirá a la misma página, pero con una señal de error
      include("login.html");
      ?>
<h1 class="error-login">USUARIO NO REGISTRADO</h1>
<?php
    }
    
    $resultado = null;    
  }
  catch(Exception $ex){
    die("Error al conectar: ". $ex->getMessage());
  }
  
}