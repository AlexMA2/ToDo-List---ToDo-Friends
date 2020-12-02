<?php
require "conexion.php";
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty(filter_input(INPUT_POST, 'update'))) {
  try{
    
    $title = htmlentities(addslashes($_POST['titulo2']));
    $description = htmlentities(addslashes($_POST['descripcion2']));
    $date = htmlentities(addslashes($_POST['fecha2']));

    $hoy = date("Y-m-d");
    if($hoy <= $date){
      $query = "UPDATE `tareas` set `title` = :title, `description` = :descripcion, `limit_date` = :fecha WHERE `id_task`= :id";
      $resultadoupdate = $conection->prepare($query);
      $resultadoupdate->bindValue(":title", $title);
      $resultadoupdate->bindValue(":descripcion", $description);
      $resultadoupdate->bindValue(":fecha", $date);
      $resultadoupdate->bindValue(":id", $id);
      $resultadoupdate->execute();
    }

  }catch(Exception $ex){
    
  }  
  header("location: TareasGrupales.php");
} 
?>