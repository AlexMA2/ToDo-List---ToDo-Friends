<?php
require "conexion.php";

$id = filter_input(INPUT_POST, 'idTarea', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
  try{
    
    $title = filter_input(INPUT_POST, 'titulo2', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'descripcion2', FILTER_SANITIZE_SPECIAL_CHARS);
    $date = filter_input(INPUT_POST, 'fecha2', FILTER_SANITIZE_SPECIAL_CHARS);
    if(strlen($title) > 128 || strlen($title) < 4 ){
    
      print_r("Error: El titulo debe tener entre 4 y 128 caracteres");
    }
    else if(strlen($description) > 256){
      print_r("Error: La descripción debe ser menor a 128 caracteres");
    } 
    else{
      if(!empty($date)){
        if(date('Y-m-d', strtotime($date)) == $date){
          $query = "UPDATE `tareas` SET `title` = :title, `description` = :descripcion, `limit_date` = :fecha WHERE `id_task`= :id";
          $resultadoupdate = $conection->prepare($query);
          $resultadoupdate->bindValue(":title", $title);
          $resultadoupdate->bindValue(":descripcion", $description);
          $resultadoupdate->bindValue(":fecha", $date);
          $resultadoupdate->bindValue(":id", $id);
          $resultadoupdate->execute();
        }
        else{
          print_r("Error: La fecha límite debe ser una fecha");
        }
      }
      else{
        $query = "UPDATE `tareas` SET `title` = :title, `description` = :descripcion, `limit_date` = :fecha WHERE `id_task`= :id";
        $resultadoupdate = $conection->prepare($query);
        $resultadoupdate->bindValue(":title", $title);
        $resultadoupdate->bindValue(":descripcion", $description);
        $resultadoupdate->bindValue(":fecha", "Sin fecha límite");
        $resultadoupdate->bindValue(":id", $id);
        $resultadoupdate->execute();
      }
      
    }
    
    

  }catch(Exception $ex){
    
  }    
  
} 
?>