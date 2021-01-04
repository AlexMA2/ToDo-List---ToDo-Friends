<?php

    require "conexion.php";
    session_start();
    $src = filter_input(INPUT_POST, 'src');
    if(isset($_SESSION['user']) && !empty($src)){
        $sql = "UPDATE `usuarios` SET `Foto`=:foto WHERE `iduser`=:id";        
        $tabla = $conection->prepare($sql);
        $tabla->bindValue(":foto", $src);
        $tabla->bindValue(":id", $_SESSION['user']);
        $tabla->execute();
    }
    

?>