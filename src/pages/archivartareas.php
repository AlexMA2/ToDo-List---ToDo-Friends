<?php

require "conexion.php";
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if(!empty($id)) {
    try{        
        $query = "INSERT INTO tareas_archivadas select * from tareas where id_task = :id";
        $resultado = $conection->prepare($query);
        $resultado->bindValue(":id", $id);
        $resultado->execute();
        $resultado = null;

        $query = "DELETE FROM `tareas` WHERE `id_task` = :id";
        $resultado = $conection->prepare($query);
        $resultado->bindValue(":id", $id);
        $resultado->execute();
        $resultado = null;
        
    }
    catch(Exception $ex){
        
    }
    header('Location: TareasGrupales.php');
}
?>
