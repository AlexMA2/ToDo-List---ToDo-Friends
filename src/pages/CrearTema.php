<?php

require 'conexion.php';
session_start();      
if (!empty(filter_input(INPUT_POST, 'CrearTema'))) {
  try{    
    $title = filter_input(INPUT_POST, 'Titulo3', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'Descripcion3', FILTER_SANITIZE_SPECIAL_CHARS);

        $query = "INSERT INTO `temas` (`Titulo`, `Descripcion`, `Usuario`) VALUES (:titulo, :descripcion, :idusuario)";
        $resultadousuario = $conection->prepare($query);
  
        $resultadousuario->bindValue(":titulo", $title);
        $resultadousuario->bindValue(":descripcion", $description);
        $resultadousuario->bindValue(":idusuario", $_SESSION['user']);
        $resultadousuario->execute();

  }catch(Exception $ex){
    
  }
  header("location:NetWork");
  
}
?>