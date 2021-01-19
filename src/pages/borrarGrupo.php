<?php 

    session_start();
    require "conexion.php";
    
    //$iduser = filter_input(INPUT_POST, 'iduser');
    $idgrupo = filter_input(INPUT_POST, 'IDGRUPO');
    if($idgrupo == -1){
        eliminarGrupo($_SESSION['grupo'], $conection);        
    }   
    else{
        eliminarGrupo($idgrupo, $conection);        
    }    

    header("location:../..");

    function eliminarGrupo($idgrupo,$conection){
        if(!empty($idgrupo)) {
            try{        
                $query = "DELETE FROM `grupos` WHERE `IDGRUPO` = :idgrupo";
                $resultadogrupo = $conection->prepare($query);
                $resultadogrupo->bindValue(":idgrupo", $idgrupo);
                $resultadogrupo->execute();
                
            }catch(Exception $ex){
                
            }
          
        }
    }

?>