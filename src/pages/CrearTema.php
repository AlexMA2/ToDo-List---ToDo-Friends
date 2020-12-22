<?php

require 'conexion.php';
session_start(); 
if (!empty(filter_input(INPUT_POST, 'CrearTema'))) {
  try{    
    $title = filter_input(INPUT_POST, 'Titulo3', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'Descripcion3', FILTER_SANITIZE_SPECIAL_CHARS);
        if(empty(filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT))){
          $query = "INSERT INTO `temas` (`Titulo`, `Descripcion`, `Usuario`) VALUES (:titulo, :descripcion, :idusuario)";
          $resultadousuario = $conection->prepare($query);
    
          $resultadousuario->bindValue(":titulo", $title);
          $resultadousuario->bindValue(":descripcion", $description);
          $resultadousuario->bindValue(":idusuario", $_SESSION['user']);
          $resultadousuario->execute();
          header("location:NetWork");
        }
        else{
          $query = "INSERT INTO `temas` (`Titulo`, `Descripcion`, `Grupo`) VALUES (:titulo, :descripcion, :idgrupo)";
          $resultadousuario = $conection->prepare($query);
    
          $resultadousuario->bindValue(":titulo", $title);
          $resultadousuario->bindValue(":descripcion", $description);
          $resultadousuario->bindValue(":idgrupo", filter_input(INPUT_GET, 'grupo', FILTER_SANITIZE_NUMBER_INT));
          $resultadousuario->execute();
          header("location:NetWorkGrupal");
        }
        

  }catch(Exception $ex){
    
  }  
  
}

?>