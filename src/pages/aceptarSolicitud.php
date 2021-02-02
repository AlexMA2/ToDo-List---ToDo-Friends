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
            
            $consulta="SELECT * FROM `otro_grupos` where `FKgrupo`= :IDGrupo and `FKusuario`= :IDUser";
            $resultado = $conection->prepare($consulta);

            $resultado->bindValue(":IDGrupo", $_SESSION['grupo']);
            $resultado->bindValue(":IDUser", $_GET['IDSoldo']);

            $resultado->execute();

            $filas = $resultado->rowCount();

            if($filas == 1){
                header("location: NetWorkGrupal");

            }else{
                $_SESSION['mensaje']="";
                $query = "INSERT INTO `otro_grupos` (`FKgrupo`, `FKusuario`) VALUES (:IDGrupo, :IDUser)";
                $resultadousuario = $conection->prepare($query);
            
                $resultadousuario->bindValue(":IDGrupo", $_SESSION['grupo']);
                $resultadousuario->bindValue(":IDUser", $_GET['IDSoldo']);
                $resultadousuario->execute();

                
                $query2 = "UPDATE `grupos` SET `Miembros`= `Miembros` + 1 WHERE `IDGRUPO` = :idgru";
                $resultado = $conection->prepare($query2);      
                $resultado->bindValue(":idgru", $_SESSION['grupo']);  
                $resultado->execute();
                
                header("location: NetWorkGrupal");
            }
            
        }catch(Exception $ex){
           
        }
      
    }
?>