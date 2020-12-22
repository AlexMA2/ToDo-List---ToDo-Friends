<?php
    
    function getInfoSobre($usuarioid){
        require "conexion.php";
        $sql = "SELECT * FROM `usuarios` WHERE `iduser` = :user";
        $resultado = $conection->prepare($sql);
        $resultado->bindValue(":user", $usuarioid);
         $resultado->execute();

        $filas = $resultado->rowCount();
        $datos = $resultado->fetch(PDO::FETCH_ASSOC);
        if($filas == 1){
            $uID = $datos["iduser"];
            $uNombre = $datos["username"];
            $uCorreo = $datos["correo"];
            $uFoto = $datos["Foto"];     
            return array($uID, $uNombre, $uCorreo, $uFoto);       
        }
    }
    
?>