<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Esta aplicacion fue creada para ayudar a una persona o a un grupo a orgnizar sus tareas.">
    <meta name="author"
        content="Gianela Mallqui, Alex Mamani, Nestor Soto, Renzo Marcos, Martin Rodriguez y Brayan Oroncuy">

    <link rel="shortcut icon" href="../../res/favicon1.png" type="image/x-icon">
    <title> To-Do Friends | Inicia Sesi&oacute;n en nuestra p&aacute;gina</title>
    <script src="../../res/jquery/jquery-3.5.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../../res/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../styles/cabecera.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

    <script src="../scripts/MenuDesplegable.js"></script>

    <link rel="stylesheet" type="text/css" href="../styles/login.css">

</head>

<?php
require "conexion.php";
$bienvenido = "BIENVENIDO";
if(!empty(filter_input(INPUT_POST, 'logearte'))){
    try{
        session_start();
        
        $usuario = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
        $contrasena = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
        $contrasena_encriptada = sha1($contrasena);        

        $consulta="SELECT * FROM `usuarios` where `correo`= :user and `password`= :pass";

        $resultado = $conection->prepare($consulta);
        $resultado->bindValue(":user", $usuario);
        $resultado->bindValue(":pass", $contrasena_encriptada);
        $resultado->execute();

        $filas = $resultado->rowCount();

        if($filas == 1){      

            $rpta = $resultado->fetch(PDO::FETCH_ASSOC);     
            $iduser = $rpta['iduser'];  

            $sql = "SELECT * FROM `expulsiones` WHERE `FKUser` = :fkuser";
            $tabla = $conection->prepare($sql);
            $tabla->bindValue(":fkuser", $iduser);           
            $tabla->execute();

            $tupla = $tabla->fetch(PDO::FETCH_ASSOC);
            if(!empty($tupla)){
                $tiempo = $tupla['Fecha'];  
                if($tiempo === "Permanente"){
                    $bienvenido = "Tu cuenta ha sido eliminada permanentemente";
                    $query = "DELETE FROM `usuarios` WHERE `iduser` = :id";
                    $resultadousuario = $conection->prepare($query);
                    $resultadousuario->bindValue(":id", $iduser);
                    $resultadousuario->execute();

                }
                else{
                    $hoy = date("Y-m-d");
                   
                    if($tiempo > $hoy){
                        $bienvenido = "Tu cuenta ha sido eliminada hasta el " . $tiempo;
                    }
                    else{
                       
                        $_SESSION['user'] = $iduser;  
                        $_SESSION['nivel'] = $rpta['Nivel'];
                        header("location:NetWork");
                    }

                }
            }     
            else{
                $_SESSION['user'] = $iduser;  
                $_SESSION['nivel'] = $rpta['Nivel'];
                header("location:NetWork");
            }   

        }else{      
            $bienvenido = "Usuario No Registrado";
        }
        
        $resultado = null;    
    }
    catch(Exception $ex){
        $bienvenido = "Hubo problemas al iniciar sesión";
    }
  
}

?>

<body>
    <header class="cabecera" style="height: 315px;">
        <div class="home">
            <a class="logo" href="../..">
                <h1> To-Do Friends </h1>
            </a>
        </div>
        <span class="btn-burger"><i class="fa fa-bars"></i></span>
        <nav class="mynav">
            <li class="nav-item text-center"><a class="nav-link" href="caracteristicas"> Caracter&iacute;sticas</a>
            </li>
            <li class="nav-item text-center"><a class="nav-link" href="tutorial"> Tutorial </a></li>
            <li class="nav-item text-center"><a class="nav-link" href="equipos"> Trabajos en Equipo </a></li>
            <li class="nav-item text-center"><a class="nav-link" href="login"> Iniciar Sesi&oacute;n </a></li>
            <li class="nav-item text-center"><a class="nav-link" href="registro">Regístrate </a> </li>
        </nav>

    </header>

    <img class="wave" src="../../res/wave.png">
    <div class="container">
        <div class="img">
            <img src="../../res/bg.svg">
        </div>
        <!--<div class="fb-login-button" data-size="medium" data-button-type="login_with" data-layout="rounded" data-auto-logout-link="true" data-use-continue-as="false" data-width=""></div>-->

        <div class="login-content">
            <form action="login" method="POST">
                <img src="../../res/avatar.svg">
                <h2 class="title"> <?php print_r($bienvenido)?> </h2>
                <div class="input-div one">
                    <i class="fas fa-user"></i>
                    <div class="div">
                        <input type="email" name="user" placeholder="Correo Electrónico" required="required"
                            autocomplete="off" value="" />
                    </div>
                </div>
                <div class="input-div pass">
                    <i class="fas fa-lock"></i>
                    <div class="div">
                        <input type="password" name="pass" placeholder="Contraseña" required="required"
                            autocomplete="off" value="" />
                    </div>
                </div>
                <a href="#">¿Olvidaste tu contraseña?</a>
                <input type="submit" name="logearte" class="btn" value="Iniciar Sesi&oacute;n">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="../scripts/main.js"></script>
    <script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: 'your-app-id',
            autoLogAppEvents: true,
            xfbml: true,
            version: 'v9.0'
        });
    };
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</body>


</html>