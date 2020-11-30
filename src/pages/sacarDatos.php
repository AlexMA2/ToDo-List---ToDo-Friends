<?php
    include("conexion.php");
    $usuario = $_SESSION['user'];
    $sql = "SELECT * FROM `usuarios` WHERE `username` = :user";
    $resultado = $conection->prepare($sql);
    $resultado->bindValue(":user", $usuario);
    $resultado->execute();

    $filas = $resultado->rowCount();
    $datos = $resultado->fetch(PDO::FETCH_ASSOC);
    if($filas == 1){
        $uCorreo = $datos["correo"];
        $uFoto = $datos["Foto"];
        
    }
?>