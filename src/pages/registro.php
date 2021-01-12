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
    $mensaje = "REGISTRATE";
    if(!empty(filter_input(INPUT_POST, 'registrar'))){
        try{                    
                
            $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_SPECIAL_CHARS);
            $usuario = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
            $contrasena = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
            $contra_repe = filter_input(INPUT_POST, 'passr', FILTER_SANITIZE_SPECIAL_CHARS);
            if(!empty($correo) && !empty($usuario) && !empty($contrasena) && !empty($contra_repe)){
                if($contrasena == $contra_repe){
                    session_start();
                    
                    $contrasena_encriptada = sha1($contrasena);
                    $sqluser = "SELECT `iduser` FROM `usuarios` WHERE `username` = :user OR `correo` = :correo";
                
                    $resultado_user = $conection->prepare($sqluser);
    
                    $resultado_user->bindValue(":user", $usuario);
                    $resultado_user->bindValue(":correo", $correo);
                    $resultado_user->execute();
    
                    $filas = $resultado_user->rowCount();
                    if($filas == 0) {
                        //insertar información del usuario
                        $sqlusuario = "INSERT INTO `usuarios` (`correo`, `username`, `password`) VALUES(:correo, :user, :pass)";
                        $resultadousuario = $conection->prepare($sqlusuario);
    
                        $resultadousuario->bindValue(":correo", $correo);
                        $resultadousuario->bindValue(":user", $usuario);
                        $resultadousuario->bindValue(":pass", $contrasena_encriptada);
                        $resultadousuario->execute();
    
                        if($resultadousuario > 0){
                            $consulta = "SELECT `iduser` FROM `usuarios` where `username`= :user and `password`= :pass";
    
                            $resultado = $conection->prepare($consulta);
    
                            $resultado->bindValue(":user", $usuario);
                            $resultado->bindValue(":pass", $contrasena_encriptada);      
                            
                            $resultado->execute();

                            $rpta = $resultado->fetch(PDO::FETCH_ASSOC);     
                            $_SESSION['user']=$rpta['iduser']; 
                            $_SESSION['nivel'] = $rpta['Nivel'];
                            header("location:NetWork");
                        } 
                        else{
                            $mensaje = "Hubo un error al introducir tus datos.";
                        }
    
                        $resultadousuario = null;
                       
                    }else {
                        $resultado_user = null;
                        $mensaje = "Usuario ya registrado";
                    }
                }
                else{
                    $mensaje = "Las contraseñas deben ser iguales";
                }
            }
            

        }   
        catch(Exception $ex){
            $mensaje = "Hubo un error al introducir tus datos.";
        } 
    }

?>
<body>
    <header class="cabecera" style="height: 315px;">
        <div class="home">
            <a class="logo" href="../../index">
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
            <li class="nav-item text-center"><a class="nav-link" href="registro">Registrarse </a> </li>
        </nav>

    </header>

    <img class="wave" src="../../res/wave.png">
    <div class="container">
        <div class="img">
            <img src="../../res/bg.svg">
        </div>
        <div class="login-content">
            <form action="registro.php" method="POST">
                <img src="../../res/avatar.svg">
                <h2 class="title"> <?php print_r($mensaje) ?></h2>
                <div class="input-div one">
                    <i class="fas fa-user"></i>
                    <div class="div">
                        <input type="text" name="user" placeholder="Nombre de usuario" required />
                    </div>
                </div>

                <div class="input-div one">
                    <i class="fa fa-envelope"></i>
                    <div class="div">
                        <input type="email" name="correo" placeholder="Correo Electrónico" required />
                    </div>
                </div>

                <div class="input-div pass">                   
                    <i class="fas fa-lock"></i>                   
                    <div class="div">                        
                        <input type="password" name="pass" placeholder="Contraseña" required />
                    </div>
                </div>
                <div class="input-div pass">                   
                    <i class="fas fa-lock"></i>                   
                    <div class="div">                        
                        <input type="password" name="passr" placeholder="Repetir contraseña" required />
                    </div>
                </div>
                <a href="#">¿Olvidaste tu contraseña?</a>
                <input type="submit" name="registrar" class="btn" value="Registrarse">

            </form>
        </div>
    </div>
    <script type="text/javascript" src="../scripts/main.js"></script>
</body>


</html>

