<?php 
    session_start();
    $_SESSION['mensaje']="";
    require "conexion.php";
    $id = filter_input(INPUT_POST, 'idTarea', FILTER_SANITIZE_NUMBER_INT);
    $id2 = filter_input(INPUT_POST, 'idTema', FILTER_SANITIZE_NUMBER_INT);
    if(!empty($id) && !empty($id2)) {
        try{       
            if($id==$id2){
                print_r("id = 1");
            }else{
                $query = "UPDATE `tareas` SET `eltema`= :IDTema WHERE `id_task` = :ID";
                $resultadousuario = $conection->prepare($query);
                $resultadousuario->bindValue(":ID", $id);
                $resultadousuario->bindValue(":IDTema", $id2);
                $resultadousuario->execute();

            }

        }catch(Exception $ex){

        }
      
    }
?>