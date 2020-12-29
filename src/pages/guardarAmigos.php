<?php
require 'conexion.php';
session_start(); 
    if (!empty(filter_input(INPUT_POST, 'btnAddAmigo'))) {

     try{
      $email = filter_input(INPUT_POST, 'emailAmigo', FILTER_SANITIZE_SPECIAL_CHARS);
        require "sacarDatos.php";
        list ($ID2, $Nombre2, $Correo2, $Foto2) = getDatos($email);

        $consulta="SELECT * FROM `otro_grupos` where `FKgrupo`= :IDGrupo and `FKusuario`= :IDUser";
        $resultado = $conection->prepare($consulta);

        $resultado->bindValue(":IDGrupo", $_SESSION['grupo']);
        $resultado->bindValue(":IDUser", $ID2);

        $resultado->execute();

        $filas = $resultado->rowCount();

        if($filas == 1){
        header("location: misequipos");

        }else{
            $query = "INSERT INTO `otro_grupos` (`FKgrupo`, `FKusuario`) VALUES (:IDGrupo, :IDUser)";
        $resultadousuario = $conection->prepare($query);
    
        $resultadousuario->bindValue(":IDGrupo", $_SESSION['grupo']);
        $resultadousuario->bindValue(":IDUser", $ID2);
        $resultadousuario->execute();      

        header("location: NetWorkGrupal?grupo=".$_SESSION['grupo']);
        } 
        //var_dump($ID2, $Nombre2, $Correo2, $Foto2);
        
        
     }
     catch(Exception $ex){
         echo "error";

     }    
    }

        


?>