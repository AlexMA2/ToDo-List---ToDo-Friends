<?php 

    session_start();
    $_SESSION['mensaje']="";
    require "conexion.php";
    $id = $_SESSION['user'];
    $id2= $_GET['IDSoldo'];
    if(!empty($id)) {
        try{        
            $query = "DELETE FROM `solicitudes` where `IDSolicitado`= :IDsolicitado and `IDGrupo`= :GRUPO";
            $resultadousuario = $conection->prepare($query);
            $resultadousuario->bindValue("IDsolicitado",$_GET['IDSoldo']);
            $resultadousuario->bindValue(":GRUPO", $_SESSION['grupo']);
            
            $resultadousuario->execute();
            
            header("location: NetWorkGrupal");
            
        }catch(Exception $ex){
           
        }
      
    }
?>