<?php
require "conexion.php";

$id = filter_input(INPUT_POST, 'idTarea', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
  try{
    
    $title = filter_input(INPUT_POST, 'titulo2', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'descripcion2', FILTER_SANITIZE_SPECIAL_CHARS);
    $date = filter_input(INPUT_POST, 'fecha2', FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "UPDATE `tareas` SET `title` = :title, `description` = :descripcion, `limit_date` = :fecha WHERE `id_task`= :id";
    $resultadoupdate = $conection->prepare($query);
    $resultadoupdate->bindValue(":title", $title);
    $resultadoupdate->bindValue(":descripcion", $description);
    $resultadoupdate->bindValue(":fecha", $date);
    $resultadoupdate->bindValue(":id", $id);
    $resultadoupdate->execute();
    

  }catch(Exception $ex){
    
  }    
  
} 
?>