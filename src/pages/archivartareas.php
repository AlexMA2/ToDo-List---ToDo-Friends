<?php

include("conexion.php");

if(isset($_GET['id'])) {
    try{
        $id = $_GET['id'];
        $query = "INSERT INTO tareas_archivadas select * from tareas where id_task = :id";
        $resultado = $conection->prepare($query);
        $resultado->bind(":id", $id);
        $resultado->execute();
        $resultado = null;

        $query = "DELETE FROM `tareas` WHERE `id_task` = :id";
        $resultado = $conection->prepare($query);
        $resultado->bindValue(":id", $id);
        $resultado->execute();
        $resultado = null;
        header('Location: TareasGrupales.php');
    }
    catch(Exception $ex){
        die("Error al conectar:  $ex->getMessage()");
    }
}
?>
