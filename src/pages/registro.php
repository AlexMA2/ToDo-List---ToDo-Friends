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
    $mensaje = "REGÍSTRATE";
    if(!empty(filter_input(INPUT_POST, 'registrar'))){
        try{                    
                
            $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_SPECIAL_CHARS);
            $usuario = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
            $contrasena = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
            $contra_repe = filter_input(INPUT_POST, 'passr', FILTER_SANITIZE_SPECIAL_CHARS);
            if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
               $mensaje = "El correo no es valido";   
               //ACTIVAR POPUP PARA VER ESTE MENSAJE PERO MEJOR            
            }
            else if(strlen($correo) < 5 || strlen($correo) > 64){
                $mensaje = "El correo debe tener una longitud entre 5 a 64 caracteres";
                //ACTIVAR POPUP PARA VER ESTE MENSAJE PERO MEJOR    
            }
            else if(strlen($usuario) < 5 || strlen($usuario) > 64){
                $mensaje = "El nombre de usuario debe tener una longitud entre 5 a 32 caracteres";
                //ACTIVAR POPUP PARA VER ESTE MENSAJE PERO MEJOR    
            }
            else if(strlen($contrasena) < 5 || strlen($contrasena) > 64){
                $mensaje = "La contraseña debe tener una longitud entre 5 a 200 caracteres";
                //ACTIVAR POPUP PARA VER ESTE MENSAJE PERO MEJOR  
            }
            else if($contrasena != $contra_repe){
                $mensaje = "Las contraseñas deben ser iguales";
                //ACTIVAR POPUP PARA VER ESTE MENSAJE PERO MEJOR  
            }
            else{
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
                        $mensaje = "No se pudo registrar tu cuenta. Intenta otra vez, porfavor.";
                        //ACTIVAR POPUP PARA VER ESTE MENSAJE PERO MEJOR  
                    }

                    $resultadousuario = null;
                
                }else {
                    $resultado_user = null;
                    $mensaje = "Usuario ya registrado";
                    //ACTIVAR POPUP PARA VER ESTE MENSAJE PERO MEJOR  
                }
            }
        }   
        catch(Exception $ex){
            $mensaje = "Hubo un error al introducir tus datos.";
            //ACTIVAR POPUP PARA VER ESTE MENSAJE PERO MEJOR  
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
            <li class="nav-item text-center"><a class="nav-link" href="registro">Regístrate </a> </li>
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
                        <input type="text" name="user" placeholder="Nombre de usuario" minlength="5" maxlength="32" required />
                    </div>
                </div>

                <div class="input-div one">
                    <i class="fa fa-envelope"></i>
                    <div class="div">
                        <input type="email" name="correo" placeholder="Correo Electrónico" minlength="5" maxlength="64"  required />
                    </div>
                </div>

                <div class="input-div pass">                   
                    <i class="fas fa-lock"></i>                   
                    <div class="div">                        
                        <input type="password" name="pass" placeholder="Contraseña" minlength="5" maxlength="200" required />
                    </div>
                </div>
                <div class="input-div pass">                   
                    <i class="fas fa-lock"></i>                   
                    <div class="div">                        
                        <input type="password" name="passr" placeholder="Repetir contraseña" minlength="5" maxlength="200" required />
                    </div>
                </div>                
                <input type="submit" name="registrar" class="btn" value="Registrarte">

            </form>
        </div>
    </div>
    <script type="text/javascript" src="../scripts/main.js"></script>
</body>


</html>

