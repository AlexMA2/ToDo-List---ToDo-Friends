<?php
    include("conexion.php");
    $usuarioid = $_SESSION['user'];
    $sql = "SELECT * FROM `usuarios` WHERE `iduser` = :user";
    $resultado = $conection->prepare($sql);
    $resultado->bindValue(":user", $usuarioid);
    $resultado->execute();

    $filas = $resultado->rowCount();
    $datos = $resultado->fetch(PDO::FETCH_ASSOC);
    if($filas == 1){
        $uNombre = $datos["username"];
        $uCorreo = $datos["correo"];
        $uFoto = $datos["Foto"];
        
    }
?>