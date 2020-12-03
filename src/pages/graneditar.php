<?php
include("conexion.php");

if (isset($_POST['update'])) {
  try{
    $id = $_GET['id'];
    $title = htmlentities(addslashes($_POST['titulo2']));
    $description = htmlentities(addslashes($_POST['descripcion2']));
    $date = htmlentities(addslashes($_POST['fecha2']));

    $query = "UPDATE `tareas` set `title` = :title, `description` = :descripcion, `limit_date` = :fecha WHERE `id_task`= :id";
    $resultadoupdate = $conection->prepare($query);
    $resultadoupdate->bindValue(":title", $title);
    $resultadoupdate->bindValue(":descripcion", $description);
    $resultadoupdate->bindValue(":fecha", $date);
    $resultadoupdate->bindValue(":id", $id);
    $resultadoupdate->execute();
    header("location: TareasGrupales.php");

  }catch(Exception $ex){
    die("Error al conectar: ". $ex->getMessage());
  }  
} 
?>