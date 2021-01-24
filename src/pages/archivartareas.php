<?php

require "conexion.php";
session_start();
$id = filter_input(INPUT_POST, 'idTarea', FILTER_SANITIZE_NUMBER_INT);
$tit = filter_input(INPUST_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
$desc = filter_input(INPUST_POST, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);

try{        
    //Seleccionar titulo y tarea
    $query = "INSERT INTO `tareas_archivadas`(`Titulo`, `Descripcion`, `Creador`) VALUES (:tit,:descr,:us)";
    $resultado = $conection->prepare($query);
    $resultado->bindValue(":tit", $tit);
    $resultado->bindValue(":descr", $desc);
    $resultado->bindValue(":us", $_SESSION['user']);
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
    

?>