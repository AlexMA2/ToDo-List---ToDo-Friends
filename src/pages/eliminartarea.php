<?php

include("conexion.php");

if(isset($_GET['id'])) {
    try{
        $id = $_GET['id'];
        $query = "DELETE FROM `tareas` WHERE `id_task` = :id";
        $resultadousuario = $conection->prepare($query);
        $resultadousuario->bindValue(":id", $id);
        $resultadousuario->execute();
        header('Location: TareasGrupales.php');
    }catch(Exception $ex){
        die("Error al conectar:  $ex->getMessage()");
        }
}
?>
