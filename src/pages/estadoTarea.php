<?php
    require 'conexion.php';
    session_start();

    $id = filter_input(INPUT_POST, 'idTarea', FILTER_SANITIZE_NUMBER_INT);

    $valor = filter_input(INPUT_POST, "valor");
    
    $query = "UPDATE `tareas` SET `estado`= :estado WHERE `id_task`= :id";
        $resultadousuario = $conection->prepare($query);
  
        $resultadousuario->bindValue(":estado", $valor);
        $resultadousuario->bindValue(":id", $id);
        $resultadousuario->execute();
        print_r($valor);      

?>