<?php
session_start();
require 'conexion.php';
require "sacarDatos.php";
$uNombre = getInfoSobre($_SESSION['user'])[1];
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

          $peticion = "SELECT * FROM `historial` WHERE `idTarea` = :idT";
          $resultado_contador = $conection->prepare($peticion);
          $resultado_contador->bindValue(":idT", $id);
          $resultado_contador->execute();
          $contador = 0;
          while($row = $resultado_contador->fetch(PDO::FETCH_ASSOC)) {
              $contador++;
          }

          $peticion = "INSERT INTO `historial` (`idTarea`, `Cambio`, `Titulo`, `Descripcion`, `Entrega`, `Autor`, `Modificacion`) VALUES (:idTarea, :Cambio, :Titulo, :Descripcion, :Entrega, :Autor, :Modificacion)";
          $resultado_historial = $conection->prepare($peticion);

          $resultado_historial->bindValue(":idTarea", $id);
          $resultado_historial->bindValue(":Titulo", $title);
          $resultado_historial->bindValue(":Cambio", $contador+1);
          $resultado_historial->bindValue(":Descripcion", $description);
          $resultado_historial->bindValue(":Entrega", $date);
          $resultado_historial->bindValue(":Autor", $uNombre);
          $resultado_historial->bindValue(":Modificacion", date("d") . "/" . date("m") . "/" . date("Y"));
          $resultado_historial->execute();

          
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

        $peticion = "SELECT * FROM `historial` WHERE `idTarea` = :idT";
        $resultado_contador = $conection->prepare($peticion);
        $resultado_contador->bindValue(":idT", $id);
        $resultado_contador->execute();
        $contador = 0;
        while($row = $resultado_contador->fetch(PDO::FETCH_ASSOC)) {
            $contador++;
        }

        $peticion = "INSERT INTO `historial` (`idTarea`, `Cambio`, `Titulo`, `Descripcion`, `Entrega`, `Autor`, `Modificacion`) VALUES (:idTarea, :Cambio, :Titulo, :Descripcion, :Entrega, :Autor, :Modificacion)";
        $resultado_historial = $conection->prepare($peticion);

        $resultado_historial->bindValue(":idTarea", $id);
        $resultado_historial->bindValue(":Titulo", $title);
        $resultado_historial->bindValue(":Cambio", $contador+1);
        $resultado_historial->bindValue(":Descripcion", $description);
        $resultado_historial->bindValue(":Entrega", "Sin fecha límite");
        $resultado_historial->bindValue(":Autor", $uNombre);
        $resultado_historial->bindValue(":Modificacion", date("d") . "/" . date("m") . "/" . date("Y"));
        $resultado_historial->execute();
        
      }
      
    }
    
    

  }catch(Exception $ex){
    
  }    
  
} 
?>