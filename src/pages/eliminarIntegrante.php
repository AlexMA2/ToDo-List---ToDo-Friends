<?php 

    session_start();
    $_SESSION['mensaje']="";
    require "conexion.php";
    $id = $_SESSION['user'];
    if(!empty($id)) {
        try{        
            $query = "DELETE FROM `otro_grupos` where `FKgrupo`= :IDGrupo and `FKusuario`= :IDUser";
            $resultadousuario = $conection->prepare($query);
            $resultadousuario->bindValue(":IDGrupo", $_SESSION['grupo']);
            $resultadousuario->bindValue("IDUser",$_GET['IDdelete']);
            $resultadousuario->execute();
            
            header("location: NetWorkGrupal");
        }catch(Exception $ex){
           
        }
      
    }
?>