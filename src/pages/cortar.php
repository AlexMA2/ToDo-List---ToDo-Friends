<?php
    require "conexion.php";
    session_start();
    $idu = $_SESSION['user'];
    $targ_w = $targ_h = 150;
    $jpeg_quality = 90;
    //$salida_archivo = '../../res/perfiles/minioto.jpg';
    //                   ../../res/perfiles/
    $src = filter_input(INPUT_POST, 'ruta');
    
    $nombreArchivoCompleto = substr($src, 19, strlen($src));       
    
    $valores2 = explode('.', $nombreArchivoCompleto);
    $nombreArchivo = $valores2[0];
    $extensionArchivo = $valores2[1];
    $nombreArchivo = 'mini-'.$nombreArchivo;    
    

    $salida_archivo = '../../res/perfiles/' . $nombreArchivo . '.' . $extensionArchivo;
    
    if($extensionArchivo == 'jpg' || $extensionArchivo == 'jpeg' ){
        $img_r = imagecreatefromjpeg($src);
    }
    else if($extensionArchivo == 'png'){
        $img_r = imagecreatefrompng($src);
    }
   
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
    
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'], $targ_w,$targ_h,$_POST['w'],$_POST['h']);
    
    //header('Content-type: image/jpeg');
    imagejpeg($dst_r, $salida_archivo, $jpeg_quality);

    $sql = "SELECT `Foto` FROM `usuarios` WHERE `iduser`=:id";
    $resultado = $conection->prepare($sql);                               
    $resultado->bindValue(":id", $idu);
    $resultado->execute();
    $dato = $resultado->fetch(PDO::FETCH_ASSOC);
    if($dato['Foto'] != $salida_archivo){
        unlink($dato['Foto']);
    }
    
    unlink($src);
    $sql = "UPDATE `usuarios` SET `Foto`=:foto WHERE `iduser`=:id";
    $resultado = $conection->prepare($sql);
    $resultado->bindValue(":foto", $salida_archivo);
    $resultado->bindValue(":id", $idu);
    $resultado->execute();
   
?>