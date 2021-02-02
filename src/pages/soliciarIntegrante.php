<?php
require 'conexion.php';
session_start(); 
    if (!empty(filter_input(INPUT_POST, 'btnSolicitar'))) {

     try{
      $email = filter_input(INPUT_POST, 'idEmailSolicitud', FILTER_SANITIZE_SPECIAL_CHARS);
        require "sacarDatos.php";
        list ($ID2, $Nombre2, $Correo2, $Foto2) = getDatos($email);

        $consulta="SELECT * FROM `solicitudes` where `IDSolicitante`= :IDSte and `IDSolicitado`= :IDSdo and `IDGrupo`= :IDG";
        $resultado = $conection->prepare($consulta);
        $resultado->bindValue(":IDSte", $_SESSION['user']);
        $resultado->bindValue(":IDSdo", $ID2);
        $resultado->bindValue(":IDG", $_SESSION['grupo']);
        

        $resultado->execute();

        $filas = $resultado->rowCount();

        if($filas == 1){
            header("location: NetWorkGrupal");

        }else{
            $_SESSION['mensaje']="";
            $query = "INSERT INTO `solicitudes` (`IDSolicitante`, `IDSolicitado` , `IDGrupo`) VALUES (:IDSte, :IDSdo, :IDG)";
            $resultadousuario = $conection->prepare($query);
        
            $resultadousuario->bindValue(":IDSte", $_SESSION['user']);
            $resultadousuario->bindValue(":IDSdo", $ID2);
            $resultadousuario->bindValue(":IDG", $_SESSION['grupo']);
            $resultadousuario->execute();

            
            header("location: NetWorkGrupal");
        } 
        //var_dump($ID2, $Nombre2, $Correo2, $Foto2);
        
        
     }
     catch(Exception $ex){
        header("location: NetWorkGrupal");
        $_SESSION['mensaje']= "error al Añadir";

     }    
    }

        


?>