<?php 

    session_start();
    require "conexion.php";
    
    $iduser = filter_input(INPUT_POST, 'iduser');
    if($iduser == -1){
        eliminarCuenta($_SESSION['user'], $conection);        
    }   
    else{
        eliminarCuenta($iduser, $conection);        
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