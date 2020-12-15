<?php
    require "conexion.php";
    
    session_start();
    $idu = $_SESSION['user'];
    try{
        if(!empty(filter_input(INPUT_POST, "perfil-guardar-nombre"))){
            $nuevo = filter_input(INPUT_POST, "perfil-nombre");
            if(!empty($nuevo)){
                
                $nuevo = trim($nuevo);
                $sql = "UPDATE `usuarios` SET `username`=:nombre WHERE `iduser`=:id";
                $resultado = $conection->prepare($sql);
                $resultado->bindValue(":nombre", $nuevo);
                $resultado->bindValue(":id", $idu);
                $resultado->execute();
                header("Location: perfilusuario");
            }
            
        }
        else if(!empty(filter_input(INPUT_POST, "perfil-guardar-correo"))){
            $nuevo = filter_input(INPUT_POST, "perfil-correo");
            if(!empty($nuevo)){
                $nuevo = trim($nuevo);    
                $sql = "SELECT `correo` FROM `usuarios` WHERE `correo` = :correo";
                $resultado = $conection->prepare($sql);         
                $resultado->bindValue(":correo", $nuevo);       
                $resultado->execute();
    
                if($resultado->rowCount() == 0){
                    $sql = "UPDATE `usuarios` SET `correo`=:correo WHERE `iduser`=:id";
                    $resultado = $conection->prepare($sql);
                    $resultado->bindValue(":correo", $nuevo);
                    $resultado->bindValue(":id", $idu);
                    $resultado->execute();
                    header("Location: perfilusuario");
                }  
            }                  
             
        }  
        else  if(!empty(filter_input(INPUT_POST, "perfil-guardar-contra"))){
            $nuevo = filter_input(INPUT_POST, "perfil-contra");
            $nuevoRepe = filter_input(INPUT_POST, "perfil-contra-repe");
            if(!empty($nuevo) && !empty($nuevoRepe)){
                $nuevo = trim($nuevo);
                $nuevoRepe = trim($nuevoRepe);
                if($nuevo == $nuevoRepe){
                    $sql = "UPDATE `usuarios` SET `password`=:contra WHERE `iduser`=:id";
                    $resultado = $conection->prepare($sql);
                    $resultado->bindValue(":contra", sha1($nuevo));
                    $resultado->bindValue(":id", $idu);
                    $resultado->execute();
                    header("Location: perfilusuario");
                }
            }
           
        }
        else if(!empty(filter_input(INPUT_POST, "perfil-guardar-foto"))){
            $imgFile = $_FILES['perfil-foto']['name'];
            $tmp_dir = $_FILES['perfil-foto']['tmp_name'];
            $imgSize = $_FILES['perfil-foto']['size'];
    
            if($imgFile){                    
    
                $upload_dir ='../../res/perfiles/';                         
                $nombreArchivo = pathinfo($imgFile, PATHINFO_FILENAME);                     
                $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
                $targetFile = $upload_dir . $nombreArchivo . '.' . $imgExt;
    
                $valid_extensions = array('jpeg', 'jpg', 'png');                                     
                if(in_array($imgExt, $valid_extensions)){
                    
                    if($imgSize <= 4000000){

                        $rutaArchivo = $nombreArchivo . '-' . strval($idu) . '.' . $imgExt;
                        $targetFile = $upload_dir . $rutaArchivo;
                        
                        if (!file_exists($targetFile)) {                            
                            
                            if (move_uploaded_file($tmp_dir, $targetFile)) {                                  
                                // Sentencia SQL
                                list($anchoIMG, $altoIMG) = getimagesize($targetFile);
        
                                if(($anchoIMG - $altoIMG <= 100 && $anchoIMG - $altoIMG >= 0) || ($altoIMG - $anchoIMG <=100 && $altoIMG - $anchoIMG >= 0)){
    
                                    $sql = "SELECT `Foto` FROM `usuarios` WHERE `iduser`=:id";
                                    $resultado = $conection->prepare($sql);                               
                                    $resultado->bindValue(":id", $idu);
                                    $resultado->execute();
    
                                    $dato = $resultado->fetch(PDO::FETCH_ASSOC);
                                    unlink($dato['Foto']);
                                   
                                    $sql = "UPDATE `usuarios` SET `Foto`=:foto WHERE `iduser`=:id";
                                    $resultado = $conection->prepare($sql);
                                    $resultado->bindValue(":foto", $targetFile);
                                    $resultado->bindValue(":id", $idu);
                                    $resultado->execute();
                                   
                                    header("location: perfilusuario");
                                }
                                else{                                        
                                    header("location: perfilusuario?errimg=".$targetFile);
                                }
                               
        
        
                            } else{
                                   
                            }
                        }
                        else{ 
                            echo "ARCHIVO YA EXISTE";
                        }
                    }
                    else{
    
                    }
                    
                    
                }
                else{
                   
                }
            
            }
            else{
               
            }
        }
        
    }     
    catch(Exception $ex){

    }
   
    

?>