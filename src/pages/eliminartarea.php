<?php

require "conexion.php";
session_start();      
$id = filter_input(INPUT_POST, 'idTarea', FILTER_SANITIZE_NUMBER_INT);
$lugar = filter_input(INPUT_POST, 'lugar');
if(!empty($id)) {
    if($lugar === "N"){
        try{        
            $query = "DELETE FROM `tareas` WHERE `id_task` = :id";
            $resultadousuario = $conection->prepare($query);
            $resultadousuario->bindValue(":id", $id);
            $resultadousuario->execute();
           
        }catch(Exception $ex){
            
        }
    }
    else if($lugar === "A"){
        
        try{        
            $query = "DELETE FROM `tareas_archivadas` WHERE `ID_ARCHIVADO` = :id";
            $resultadousuario = $conection->prepare($query);
            $resultadousuario->bindValue(":id", $id);
            $resultadousuario->execute();
            
        }catch(Exception $ex){
            
        }
    }
    
    
}
?>
