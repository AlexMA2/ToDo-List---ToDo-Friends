<?php
require "conexion.php";
session_start();
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if (!empty(filter_input(INPUT_POST, 'update'))) {
  try{
    
    $title = filter_input(INPUT_POST, 'titulo2', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'descripcion2', FILTER_SANITIZE_SPECIAL_CHARS);
    $date = filter_input(INPUT_POST, 'fecha2', FILTER_SANITIZE_SPECIAL_CHARS);

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
  if(empty(filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT))){
    header("location:TareasGrupales?tema=".$_SESSION['tema']);
  } 
  else{
    header("location:TareasGrupales?tema=".$_SESSION['tema']."&grupo=".filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT));
  }
} 
?>