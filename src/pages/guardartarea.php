<?php

require 'conexion.php';
session_start();      

try{    
  $title = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
  $description = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_SPECIAL_CHARS);
  $date = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_SPECIAL_CHARS);    
  if(strlen($title) > 128 || strlen($title) < 4 ){
    
    print_r("Error: El titulo debe tener entre 4 y 128 caracteres");
  }
  else if(strlen($description) > 256){
    print_r("Error: La descripción debe ser menor a 128 caracteres");
  }  
  else{
    if(!empty($date)){
      if(date('Y-m-d', strtotime($date)) == $date){
        $hoy = date("Y-m-d");
        if($hoy <= $date){
          $query = "INSERT INTO `tareas` (`title`, `description`, `limit_date`, `eltema`) VALUES (:titulo, :descripcion, :fecha, :tema)";
          $resultadousuario = $conection->prepare($query);
    
          $resultadousuario->bindValue(":titulo", $title);
          $resultadousuario->bindValue(":descripcion", $description);
          $resultadousuario->bindValue(":fecha", $date);
          $resultadousuario->bindValue(":tema", $_SESSION['tema']);
          $resultadousuario->execute();      
        
        }
        else{
          print_r("Error: La fecha límite debe ser una fecha futura");
        }
      }
      else{
        print_r("Error: La fecha límite debe ser una fecha");
      }
      
    }
    else{
      $query = "INSERT INTO `tareas` (`title`, `description`, `limit_date`, `eltema`) VALUES (:titulo, :descripcion, :fecha, :tema)";
      $resultadousuario = $conection->prepare($query);
  
      $resultadousuario->bindValue(":titulo", $title);
      $resultadousuario->bindValue(":descripcion", $description);
      $resultadousuario->bindValue(":fecha", "Sin fecha límite");
      $resultadousuario->bindValue(":tema", $_SESSION['tema']);
      $resultadousuario->execute();      
    }
  }
  
  
  
  
}catch(Exception $ex){
  
}

  
?>