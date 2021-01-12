<?php 

    session_start();
    $_SESSION['mensaje']="";
    require "conexion.php";
    $id = $_SESSION['user'];
    $id2=$_GET['IDdelete'];
    if(!empty($id)) {
        try{        
            $query = "DELETE FROM `otro_grupos` where `FKgrupo`= :IDGrupo and `FKusuario`= :IDUser";
            $resultadousuario = $conection->prepare($query);
            $resultadousuario->bindValue(":IDGrupo", $_SESSION['grupo']);
            $resultadousuario->bindValue(":IDUser",$id2);
            $resultadousuario->execute();
            if($id==$id2){
                header("location: MisEquipos");
            }else{
                header("location: NetWorkGrupal");
            }
            
        }catch(Exception $ex){
           
        }
      
    }
?>