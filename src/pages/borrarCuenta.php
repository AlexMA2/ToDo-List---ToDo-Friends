<?php 

    session_start();
    require "conexion.php";
    $id = $_SESSION['user'];
    if(!empty($id)) {
        try{        
            $query = "DELETE FROM `usuarios` WHERE `iduser` = :id";
            $resultadousuario = $conection->prepare($query);
            $resultadousuario->bindValue(":id", $id);
            $resultadousuario->execute();
            header('Location: ../..');
        }catch(Exception $ex){
            
        }
      
    }
?>