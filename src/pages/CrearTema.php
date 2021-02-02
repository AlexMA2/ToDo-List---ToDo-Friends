<?php

require 'conexion.php';
session_start(); 

try{    
  $title = filter_input(INPUT_POST, 'Titulo3', FILTER_SANITIZE_SPECIAL_CHARS);
  $description = filter_input(INPUT_POST, 'Descripcion3', FILTER_SANITIZE_SPECIAL_CHARS);
  if(strlen($title) < 4 || strlen($title) > 16){
    //Activar popup con el error
    print_r("Error: El titulo debe tener entre 4 y 16 caracteres");
  }
  else if(strlen($description) > 64){
    //Activar popup con el error
    print_r("Error: La descripción debe tener menos de 64 caracteres");
  }
  else{
    print_r("Aceptado");
    if(empty($_SESSION['grupo'])){
      $query = "INSERT INTO `temas` (`Titulo`, `Descripcion`, `Usuario`) VALUES (:titulo, :descripcion, :idusuario)";
      $resultado = $conection->prepare($query);
      $resultado->bindValue(":titulo", $title);
      $resultado->bindValue(":descripcion", $description);
      $resultado->bindValue(":idusuario", $_SESSION['user']);
      $resultado->execute();
     
    }
    else{
      $query = "INSERT INTO `temas` (`Titulo`, `Descripcion`, `Grupo`) VALUES (:titulo, :descripcion, :idgrupo)";
      $resultado = $conection->prepare($query);
      $resultado->bindValue(":titulo", $title);
      $resultado->bindValue(":descripcion", $description);
      $resultado->bindValue(":idgrupo", $_SESSION['grupo']);
      $resultado->execute();
      
      $query = "UPDATE `grupos` SET `Temas`= `Temas` + 1 WHERE `IDGRUPO` = :idgru";
      $resultado = $conection->prepare($query);      
      $resultado->bindValue(":idgru", $_SESSION['grupo']);  
      $resultado->execute();
      
    }
  }
  
      
}catch(Exception $ex){
  
}  



?>