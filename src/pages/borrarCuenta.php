<?php 

    session_start();
    require "conexion.php";
    
    $iduser = filter_input(INPUT_POST, 'iduser', FILTER_SANITIZE_NUMBER_INT);
    $razon = filter_input(INPUST_POST, 'razon', FILTER_SANITIZE_SPECIAL_CHARS);
    $tiempo = filter_input(INPUT_POST, 'tiempo', FILTER_SANITIZE_SPECIAL_CHARS);

    if($iduser == -1){
        eliminarCuenta($_SESSION['user'], $conection);        
    }   
    else{
        if(empty($razon)){
            print_r("Error: Se debe establecer la razón");
        }
        else if(date('Y-m-d', strtotime($tiempo)) == $tiempo){
            print_r("Aceptado");
            if(!empty($tiempo)){

                $sql = "INSERT INTO `expulsiones` (`FKUser`, `Fecha`, `Razon`) VALUES (:iduser, :fecha, :razon)";
                $tabla = $conection->prepare($sql);
                $tabla->bindValue(":iduser", $iduser);
                $tabla->bindValue(":fecha", $tiempo);
                $tabla->bindValue(":razon", $razon);
                $tabla->execute();
    
            }
            else{            
    
                $sql = "INSERT INTO `expulsiones` (`FKUser`, `Fecha`, `Razon`) VALUES (:iduser, :fecha, :razon)";
                $tabla = $conection->prepare($sql);
                $tabla->bindValue(":iduser", $iduser);
                $tabla->bindValue(":fecha", "Permanente");
                $tabla->bindValue(":razon", $razon);
                $tabla->execute();
    
            }
            eliminarCuenta($iduser, $conection);
        }
        else{
            print_r("Error: La fecha de desbaneo debe ser una fecha");
        }
          
    }    

    function eliminarCuenta($iduser,$conection){
        if(!empty($iduser)) {
            try{        
                $query = "DELETE FROM `usuarios` WHERE `iduser` = :id";
                $resultadousuario = $conection->prepare($query);
                $resultadousuario->bindValue(":id", $iduser);
                $resultadousuario->execute();
                
            }catch(Exception $ex){
                
            }
          
        }
    }

?>