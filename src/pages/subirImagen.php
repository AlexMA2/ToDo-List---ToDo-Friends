<?php

    require "conexion.php";
    session_start();
    $src = filter_input(INPUT_POST, 'src');
    $antigua = filter_input(INPUT_POST, 'antigua');

    if(isset($_SESSION['user']) && !empty($src)){

        //$result = \Cloudinary\Uploader::destroy($public_id, $options = array());

        $sql = "UPDATE `usuarios` SET `Foto`=:foto WHERE `iduser`=:id";        
        $tabla = $conection->prepare($sql);
        $tabla->bindValue(":foto", $src);
        $tabla->bindValue(":id", $_SESSION['user']);
        $tabla->execute();
    }
    

?>