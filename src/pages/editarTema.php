<?php
require "conexion.php";

$id = filter_input(INPUT_POST, 'IDTEMA', FILTER_SANITIZE_NUMBER_INT);
if (!empty($id)) {
  try{
    
    $title = filter_input(INPUT_POST, 'Titulo4', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'Descripcion4', FILTER_SANITIZE_SPECIAL_CHARS);

    $query = "UPDATE `temas` SET `Titulo` = :title, `Descripcion` = :descripcion WHERE `IDTEMA`= :id";
    $resultadoupdate = $conection->prepare($query);
    $resultadoupdate->bindValue(":title", $title);
    $resultadoupdate->bindValue(":descripcion", $description);
    $resultadoupdate->bindValue(":id", $id);
    $resultadoupdate->execute();
    
  }catch(Exception $ex){

  }    
  
} 
?>