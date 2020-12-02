<?php
    require "conexion.php";

    $aCambiar = filter_input(INPUT_GET, 'campo', FILTER_SANITIZE_SPECIAL_CHARS);
    $idu = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if(!empty($aCambiar) && !empty($idu)){
        try{
            
            if($aCambiar == "nombre"){                
                if(!empty(filter_input(INPUT_POST, "perfil-guardar-nombre"))){
                    $nuevo = filter_input(INPUT_POST, "perfil-nombre");
                    if(!empty($nuevo)){
                        
                        $nuevo = trim($nuevo);
                        $sql = "UPDATE `usuarios` SET `username`=:nombre WHERE `iduser`=:id";
                        $resultado = $conection->prepare($sql);
                        $resultado->bindValue(":nombre", $nuevo);
                        $resultado->bindValue(":id", $idu);
                        $resultado->execute();
                    }
                    
                }
                
            }
            else if($aCambiar == "correo"){
                if(!empty(filter_input(INPUT_POST, "perfil-guardar-correo"))){
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
                        }  
                    }                  
                     
                }                
               
            }
            else if($aCambiar == "contra"){
                if(!empty(filter_input(INPUT_POST, "perfil-guardar-contra"))){
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
                        }
                    }
                   
                }
                                                
            }        
            else if($aCambiar == "foto"){
                /*
                    1) Obtener el ancho y alto de una imagen.
                    2) Obtener resolucion en px
                    3) Crear un modificador del tamaño de imagenes para seleccionar un circulo.
                
                */
                if(!empty(filter_input(INPUT_POST, "perfil-guardar-foto"))){
                    $imgFile = $_FILES['perfil-foto']['name'];
                    $tmp_dir = $_FILES['perfil-foto']['tmp_name'];
                    $imgSize = $_FILES['perfil-foto']['size'];

                    if($imgFile){                    

                        $upload_dir ='../../res/perfiles/';                         
                        $nombreArchivo = pathinfo($imgFile, PATHINFO_FILENAME);                     
                        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
                        $targetFile = $upload_dir . $nombreArchivo . '.' . $imgExt;

                        $valid_extensions = array('jpeg', 'jpg', 'png'); 
                        $archivo_repe = 0;                        
                        if(in_array($imgExt, $valid_extensions)){
                            if($imgSize <= 4000000){
                                
                                while (file_exists($targetFile)) {
                                    $archivo_repe +=1;
                                    $nombreArchivo = $nombreArchivo . strval($archivo_repe) . '.' . $imgExt;
                                    $targetFile = $upload_dir . $nombreArchivo;
                                }
                                
                                if (move_uploaded_file($tmp_dir, $targetFile)) {                                  
                                    // Sentencia SQL
                                    $sql = "UPDATE `usuarios` SET `Foto`=:foto WHERE `iduser`=:id";
                                    $resultado = $conection->prepare($sql);
                                    $resultado->bindValue(":foto", $targetFile);
                                    $resultado->bindValue(":id", $idu);
                                    $resultado->execute();


                                } else{
                                   
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
            //header("location: perfilusuario.php");
        }
        catch(Exception $ex){
            die("Error al conectar: ". $ex->getMessage());
        }
        
    }

?>