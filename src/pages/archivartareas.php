<?php

require "conexion.php";
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)) {
    try{        
       
        $query = "INSERT INTO tareas_archivadas SELECT `id_task`, `title`, `description`, `limit_date` FROM tareas WHERE id_task = :id";
        $resultado = $conection->prepare($query);
        $resultado->bindValue(":id", $id);
        $resultado->execute();
        
        $resultado = null;

        $query = "DELETE FROM `tareas` WHERE `id_task` = :id";
        $resultado = $conection->prepare($query);
        $resultado->bindValue(":id", $id);
        $resultado->execute();
        
        $resultado = null;
        header("location:TareasGrupales?tema=".$_SESSION['tema']);
    }
    catch(Exception $ex){
        
    }
    
}
?>
