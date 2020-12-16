<?php

require "conexion.php";
session_start();      
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)) {
    try{        
        $query = "DELETE FROM `tareas` WHERE `id_task` = :id";
        $resultadousuario = $conection->prepare($query);
        $resultadousuario->bindValue(":id", $id);
        $resultadousuario->execute();
        header('Location: TareasGrupales');
    }catch(Exception $ex){
        
    }
    header("location:TareasGrupales?tema=".$_SESSION['tema']);
}
?>
