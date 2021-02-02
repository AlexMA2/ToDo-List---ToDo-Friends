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

        $query2 = "UPDATE `grupos` SET `Temas`= `Temas` - 1 WHERE `IDGRUPO` = :idgru";
        $resultado = $conection->prepare($query2);      
        $resultado->bindValue(":idgru", $_SESSION['grupo']);  
        $resultado->execute();
      
    }catch(Exception $ex){
        
    }
    
}
?>