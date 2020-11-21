<?php
include("conexion.php");

//Registrar usuario

if(isset($_POST["registrar"])){
    $correo = mysqli_real_escape_string($conection, $_POST['correo']);
    $usuario = mysqli_real_escape_string($conection, $_POST['user']);
    $contraseña = mysqli_real_escape_string($conection, $_POST['pass']);
    $contraseña_encriptada = sha1($contraseña);
    $sqluser = "SELECT iduser FROM usuarios WHERE username = '$usuario'";

    $resultado_user = $conection->query($sqluser);
    $filas = $resultado_user->num_rows;
    if($filas > 0) {
        echo "<script>
            alert('El usuario ya existe');
            window.location = 'login.html';
        </script>";
    }else {
        //insertar información del usuario
        $sqlusuario = "INSERT INTO usuarios
                            (correo, username, password)
                                VALUES('$correo', '$usuario', '$contraseña_encriptada')";
        $resultadousuario = $conection->query($sqlusuario);
        if($resultadousuario > 0){
            echo "<script>
            alert('Registro exitoso');
            window.location = 'login.html';
        </script>";
        } else{
            echo "<script>
            alert('Error al registrarse');
            window.location = 'registro.php';
        </script>";
        }
    }
}

?>