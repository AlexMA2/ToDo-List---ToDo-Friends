<?php

require 'conexion.php';
session_start(); 
if (!empty(filter_input(INPUT_POST, 'CrearTema'))) {
  try{    
    $title = filter_input(INPUT_POST, 'Titulo3', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'Descripcion3', FILTER_SANITIZE_SPECIAL_CHARS);
    if(empty($_SESSION['grupo'])){
      $query = "INSERT INTO `temas` (`Titulo`, `Descripcion`, `Usuario`) VALUES (:titulo, :descripcion, :idusuario)";
      $resultado = $conection->prepare($query);
      $resultado->bindValue(":titulo", $title);
      $resultado->bindValue(":descripcion", $description);
      $resultado->bindValue(":idusuario", $_SESSION['user']);
      $resultado->execute();
      header("location:NetWork");
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
      header("location:NetWorkGrupal");
    }
        

  }catch(Exception $ex){
    
  }  
  
}

?>