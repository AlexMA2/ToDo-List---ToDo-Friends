<?php
session_start();
require 'conexion.php';
require "sacarDatos.php";
$uNombre = getInfoSobre($_SESSION['user'])[1];

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
    $query = "SELECT `id_task` FROM `tareas` WHERE `title` = :tit AND `eltema` = :tema";
    $resultado = $conection->prepare($query);
    $resultado->bindValue(":tit", $title);
    $resultado->bindValue(":tema", $_SESSION['tema']);
    $resultado->execute();
    $filas = $resultado->rowCount();
    if($filas === 0){      
      //El titulo no existe y puedes crear una tarea con ese titulo
      if(!empty($date)){
        if(date('Y-m-d', strtotime($date)) == $date){
          $hoy = date("Y-m-d");
          if($hoy <= $date){
            print_r("Aceptado");
            $query = "INSERT INTO `tareas` (`title`, `description`, `limit_date`, `eltema`) VALUES (:titulo, :descripcion, :fecha, :tema)";
            $resultadousuario = $conection->prepare($query);
      
            $resultadousuario->bindValue(":titulo", $title);
            $resultadousuario->bindValue(":descripcion", $description);
            $resultadousuario->bindValue(":fecha", $date);
            $resultadousuario->bindValue(":tema", $_SESSION['tema']);
            $resultadousuario->execute();

            $anotherquery = "SELECT `id_task` FROM `tareas` WHERE `title` = :titulo AND `description` = :descripcion AND `limit_date` = :fecha AND `eltema` = :tema";
            $resultado_id = $conection->prepare($anotherquery);

            $resultado_id->bindValue(":titulo", $title);
            $resultado_id->bindValue(":descripcion", $description);
            $resultado_id->bindValue(":fecha", $date);
            $resultado_id->bindValue(":tema", $_SESSION['tema']);
            $resultado_id->execute();

            $peticion = "INSERT INTO `historial` (`idTarea`, `Titulo`, `Descripcion`, `Entrega`, `Autor`, `Modificacion`) VALUES (:idTarea, :Titulo, :Descripcion, :Entrega, :Autor, :Modificacion)";
            $resultado_historial = $conection->prepare($peticion);
            $data = $resultado_id->fetch(PDO::FETCH_ASSOC);

            $resultado_historial->bindValue(":idTarea", $data['id_task']);
            $resultado_historial->bindValue(":Titulo", $title);
            $resultado_historial->bindValue(":Descripcion", $description);
            $resultado_historial->bindValue(":Entrega", $date);
            $resultado_historial->bindValue(":Autor", $uNombre);
            $resultado_historial->bindValue(":Modificacion", date("d") . "/" . date("m") . "/" . date("Y"));
            $resultado_historial->execute();
          
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
        print_r("Aceptado");
        $query = "INSERT INTO `tareas` (`title`, `description`, `limit_date`, `eltema`) VALUES (:titulo, :descripcion, :fecha, :tema)";
        $resultadousuario = $conection->prepare($query);
    
        $resultadousuario->bindValue(":titulo", $title);
        $resultadousuario->bindValue(":descripcion", $description);
        $resultadousuario->bindValue(":fecha", "Sin fecha límite");
        $resultadousuario->bindValue(":tema", $_SESSION['tema']);
        $resultadousuario->execute();

        $anotherquery = "SELECT `id_task` FROM `tareas` WHERE `title` = :titulo AND `description` = :descripcion AND `limit_date` = :fecha AND `eltema` = :tema";
        $resultado_id = $conection->prepare($anotherquery);

        $resultado_id->bindValue(":titulo", $title);
        $resultado_id->bindValue(":descripcion", $description);
        $resultado_id->bindValue(":fecha", "Sin fecha límite");
        $resultado_id->bindValue(":tema", $_SESSION['tema']);
        $resultado_id->execute();

        $peticion = "INSERT INTO `historial` (`idTarea`,`Titulo`, `Descripcion`, `Entrega`, `Autor`, `Modificacion`) VALUES (:idTarea, :Titulo, :Descripcion, :Entrega, :Autor, :Modificacion)";
        $resultado_historial = $conection->prepare($peticion);
        $data = $resultado_id->fetch(PDO::FETCH_ASSOC);

        $resultado_historial->bindValue(":idTarea", $data);
        $resultado_historial->bindValue(":Titulo", $title);
        $resultado_historial->bindValue(":Descripcion", $description);
        $resultado_historial->bindValue(":Entrega", "Sin fecha límite");
        $resultado_historial->bindValue(":Autor", $uNombre);
        $resultado_historial->bindValue(":Modificacion", date("d") . "/" . date("m") . "/" . date("Y"));
        $resultado_historial->execute();
      }
      
    }else{     
      //El titulo ya existe, por lo tanto ya existe esa tarea 
      print_r("Error: El titulo ya existe, por lo tanto ya existe esa tarea ");
    }
    
  }
  
  
  
  
}catch(Exception $ex){
  
}

  
?>