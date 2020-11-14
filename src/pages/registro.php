<?php
    require_once "conexion.php";

    $correo = $user = $pass = "";
    $correo_err = $user_err = $pass_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["user"]))){
            $user_err = "Por favor ingresar nombre de usuario.";
        }else{
            $sql = "SELECT id FROM usuarios WHERE user = ?";

            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_user);

                $param_user = trim($_POST["user"]);

                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $user_err = "Nombre de usuario ya registrado";
                    }else{
                        $user = trim($_POST["user"]);
                    }
                }else{
                    echo "Algo salió mal, inténtalo luego";
                }
            }
        }

        if(empty(trim($_POST["correo"]))){
            $correo_err = "Por favor ingresar correo electrónico.";
        }else{
            $sql = "SELECT id FROM usuarios WHERE correo = ?";

            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_user);

                $param_correo = trim($_POST["correo"]);

                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $correo_err = "Correo electrónico ya registrado";
                    }else{
                        $correo = trim($_POST["correo"]);
                    }
                }else{
                    echo "Algo salió mal, inténtalo luego";
                }
            }
        }

        if(empty(trim($_POST["pass"]))){
            $pass_err = "Por favor, ingresar contraseña";
        }elseif(strlen(trim($_POST["pass"])) < 4){
            $pass_err = "La contraseña debe tener al menos 4 caracteres.";
        }else{
            $pass = trim($_POST["pass"]);
        }

        if(empty($user_err) && empty($correo_err) && empty($pass_err)){
            $sql = "INSERT INTO usuarios (correo, username, password) VALUES (?, ?, ?)";

            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "sss", $param_user, $param_correo, $param_pass);

                $param_user = $user;
                $param_correo = $correo;
                $param_pass = password_hash($password, PASSWORD_DEAFULT);
                
                if(mysqli_stmt_execute($stmt)){
                    header("location_ index.php");
                }else{
                    echo "Algo salió mal, intentar luego.";
                }
            }
        }
        $mysqli_close($link);
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> To-Do Friends | Registrate en nuestra p&aacute;gina </title>
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="../styles/cabecera.css">

    <link rel="shortcut icon" href="../../res/favicon1.png" type="image/x-icon">    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>    
    <link rel="stylesheet" href="../../res/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <script src="../../res/jquery/jquery-3.5.1.min.js"></script>
    
    <link rel="stylesheet" href="../../font-awesome-4.7.0/css/font-awesome.css">    
    <script src="../scripts/main.js"></script>
</head>
<body>
    <div class="container-md">
        <header class="row cabecera">
            <div class="home">
                <a class="logo" href="../../index.html">
                    <img src="../../res/favicon1.png" alt="logo">
                    <h1> To-Do Friends </h1>
                </a>
            </div>
            <span class="btn-burger"><i class="fa fa-bars"></i></span>
            <nav class="navbar nav mynav">
                <li class="nav-item text-center"><a class="nav-link" href="nosotros.html"> Nosotros </a></li>
                <li class="nav-item text-center"><a class="nav-link" href="tutorial.html"> Tutorial </a></li>
                <li class="nav-item text-center"><a class="nav-link" href="equipos.html"> Equipos </a></li>
                <li class="nav-item text-center"><a class="nav-link" href="login.html"> Iniciar Sesi&oacute;n </a></li>
                <li class="nav-item text-center"><a class="nav-link" href="registro.html">Registrarse </a> </li>
            </nav>
        </header>

    </div>
    <div class="login">
        <h1> Registrarse </h1>
        <form action="<?php echo htmlspecialchars $_SERVER["PHP_SELF"]; ?>"; method="post">
            <input type="email" name="correo" placeholder="Correo Electrónico" required="required" />
            <span class="msg-error"><?php echo $correo_err; ?></span>
            <input type="text" name="user" placeholder="Nombre de usuario" required="required" />
            <span class="msg-error"> <?php echo $correo_err; ?></span>
            <input type="password" name="pass" placeholder="Contraseña" required="required" />
            <span class = "msg-error"> <?php echo $pass_err; ?></span>
            <button type="submit" name = "registrar" class="btn btn-primary btn-block btn-large"> Crear Cuenta </button>
        </form>
    </div>
</body>
</html>