<?php
    require "conexion.php";
    
    session_start();
    $idu = $_SESSION['user'];
    try{
        if(!empty(filter_input(INPUT_POST, "perfil-guardar-nombre"))){
            $nuevo = filter_input(INPUT_POST, "perfil-nombre");
            if(!empty($nuevo)){
                
                $nuevo = trim($nuevo);
                $sql = "UPDATE `usuarios` SET `username`=:nombre WHERE `iduser`=:id";
                $resultado = $conection->prepare($sql);
                $resultado->bindValue(":nombre", $nuevo);
                $resultado->bindValue(":id", $idu);
                $resultado->execute();
                header("Location: perfilusuario");
            }
            
        }
        else if(!empty(filter_input(INPUT_POST, "perfil-guardar-correo"))){
            $nuevo = filter_input(INPUT_POST, "perfil-correo");
            if(!empty($nuevo)){
                $nuevo = trim($nuevo);    
                $sql = "SELECT `correo` FROM `usuarios` WHERE `correo` = :correo";
                $resultado = $conection->prepare($sql);         
                $resultado->bindValue(":correo", $nuevo);       
                $resultado->execute();
    
                if($resultado->rowCount() == 0){
                    $sql = "UPDATE `usuarios` SET `correo`=:correo WHERE `iduser`=:id";
                    $resultado = $conection->prepare($sql);
                    $resultado->bindValue(":correo", $nuevo);
                    $resultado->bindValue(":id", $idu);
                    $resultado->execute();
                    header("Location: perfilusuario");
                }  
            }                  
             
        }  
        else  if(!empty(filter_input(INPUT_POST, "perfil-guardar-contra"))){
            $nuevo = filter_input(INPUT_POST, "perfil-contra");
            $nuevoRepe = filter_input(INPUT_POST, "perfil-contra-repe");
            if(!empty($nuevo) && !empty($nuevoRepe)){
                $nuevo = trim($nuevo);
                $nuevoRepe = trim($nuevoRepe);
                if($nuevo == $nuevoRepe){
                    $sql = "UPDATE `usuarios` SET `password`=:contra WHERE `iduser`=:id";
                    $resultado = $conection->prepare($sql);
                    $resultado->bindValue(":contra", sha1($nuevo));
                    $resultado->bindValue(":id", $idu);
                    $resultado->execute();
                    header("Location: perfilusuario");
                }
            }
           
        }
        
        
    }     
    catch(Exception $ex){

    }
   
    

?>