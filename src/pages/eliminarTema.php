<?php

require "conexion.php";
session_start();      
$id = filter_input(INPUT_POST, 'IDTEMA', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)) {
    try{        
        $query = "DELETE FROM `temas` WHERE `IDTEMA` = :id";
        $resultadousuario = $conection->prepare($query);
        $resultadousuario->bindValue(":id", $id);
        $resultadousuario->execute();
    }catch(Exception $ex){
        
    }
    
}
?>