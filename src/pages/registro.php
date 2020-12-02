<?php
    require "conexion.php";
    //Registrar usuario
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
                           
                            header("location:NetWork");
                        } 
                        else{
                            header("location:registro.html");
                        }
    
                        $resultadousuario = null;
                       
                    }else {
                        $resultado_user = null;
                        include("registro.html")
                        ?>
                        <h1 class="error-registro"> YA EXISTE UNA CUENTA CON ESE CORREO O CON ESE NOMBRE DE USUARIO</h1>                    
                        <?php
                    }
                }
            }
            

        }   
        catch(Exception $ex){
            
        } 
    }

?>