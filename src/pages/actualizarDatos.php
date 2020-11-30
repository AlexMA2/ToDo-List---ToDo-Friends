<?php
    include("conexion.php");
    if(isset($_GET["campo"])){
        $aCambiar = $_GET["campo"];
        if($aCambiar == "nombre"){
            $nuevo = $_POST["perfil-nombre"];
            $sql = "UPDATE `usuarios` SET `username`=:nombre WHERE `username`=:antiguo";
            $resultado = $conection->prepare($sql);
            $resultado->bindValue(":nombre", $nuevo);
            $resultado->bindValue(":username", $nuevo);
            
        }
        else if($aCambiar == "correo"){
            $nuevo = $_POST["perfil-correo"];
            $sql = "UPDATE `usuarios` SET `correo`=:nombre WHERE `correo`=:antiguo";
            $resultado = $conection->prepare($sql);
            $resultado->bindValue(":nombre", $nuevo);
            $resultado->bindValue(":username", $nuevo);
        }
        else if($aCambiar == "contra"){
            $nuevo = $_POST["perfil-contra"];
            $sql = "UPDATE `usuarios` SET `password`=:contra WHERE `password`=:antiguo";
            $resultado = $conection->prepare($sql);
            $resultado->bindValue(":nombre", $nuevo);
            $resultado->bindValue(":username", $nuevo);
        }        
    }

?>