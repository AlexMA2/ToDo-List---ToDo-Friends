<?php 

    session_start();
    $_SESSION['mensaje']="";
    require "conexion.php";
    $id = $_SESSION['user'];
    $id2= $_GET['IDdelete'];
    if(!empty($id)) {
        try{        
            $query = "DELETE FROM `otro_grupos` where `FKgrupo`= :IDGrupo and `FKusuario`= :IDUser";
            $resultadousuario = $conection->prepare($query);
            $resultadousuario->bindValue(":IDGrupo", $_SESSION['grupo']);
            $resultadousuario->bindValue("IDUser",$_GET['IDdelete']);
            $resultadousuario->execute();
            
            $query2 = "UPDATE `grupos` SET `Miembros`= `Miembros` - 1 WHERE `IDGRUPO` = :idgru";
            $resultado = $conection->prepare($query2);      
            $resultado->bindValue(":idgru", $_SESSION['grupo']);  
            $resultado->execute();
            
            if($id==$id2){
                header("location: MisEquipos");
            }else{
                header("location: NetWorkGrupal");
            }
            
        }catch(Exception $ex){
           
        }
      
    }
?>