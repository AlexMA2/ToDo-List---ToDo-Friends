<?php

    require_once "conexion.php";
    session_start();
    $id = filter_input(INPUT_POST, 'idArch', FILTER_SANITIZE_NUMBER_INT);
    $tit = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
    $des = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);

    try{

        $query = "INSERT INTO `tareas` (`title`, `description`, `limit_date`, `eltema`) VALUES (:titulo, :descripcion, :fecha, :tema)";
        $resultado = $conection->prepare($query);
    
        $resultado->bindValue(":titulo", $tit);
        $resultado->bindValue(":descripcion", $des);
        $resultado->bindValue(":fecha", "Sin fecha límite");
        $resultado->bindValue(":tema", $_SESSION['tema']);
        $resultado->execute();

        $query = "SELECT `id_task` FROM `tareas` WHERE `title` = :tit AND `eltema` = :tema";
        $resultado->bindValue(":tit", $tit);
        $resultado->bindValue(":tema", $_SESSION['tema']);
        $resultado->execute();
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            print_r($row['id_task']);
        }

        $query = "DELETE FROM `tareas_archivadas` WHERE `ID_ARCHIVADO` = :id";
        $resultado = $conection->prepare($query);
        $resultado->bindValue(":id", $id);
        $resultado->execute();

    }catch(Exception $ex){

    }

?>