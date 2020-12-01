<?php
    include("conexion.php");

    if(isset($_GET["campo"]) && isset($_GET["id"])){
        try{
            $aCambiar = $_GET["campo"];
            $idu = $_GET["id"];
            if($aCambiar == "nombre"){
                if(isset($_POST["perfil-guardar-nombre"])){
                    $nuevo = $_POST["perfil-nombre"];
                    $nuevo = trim($nuevo);
                    $sql = "UPDATE `usuarios` SET `username`=:nombre WHERE `iduser`=:id";
                    $resultado = $conection->prepare($sql);
                    $resultado->bindValue(":nombre", $nuevo);
                    $resultado->bindValue(":id", $idu);
                    $resultado->execute();
                }
                
            }
            else if($aCambiar == "correo"){
                if(isset($_POST["perfil-guardar-correo"])){
                    $nuevo = $_POST["perfil-correo"];
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
            else if($aCambiar == "contra"){
                if(isset($_POST["perfil-guardar-contra"])){
                    $nuevo = $_POST["perfil-contra"];
                    $nuevoRepe = $_POST["perfil-contra-repe"];
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
            else if($aCambiar == "foto"){
                /*
                    1) Obtener el ancho y alto de una imagen.
                    2) Obtener resolucion en px
                    3) Crear un modificador del tamaño de imagenes para seleccionar un circulo.
                
                */
                if(isset($_POST["perfil-guardar-foto"])){
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
                                    echo "El archivo  ". htmlspecialchars( basename( $tmp_dir)). " ha sido subido";
                                    // Sentencia SQL

                                    $sql = "UPDATE `usuarios` SET `Foto`=:foto WHERE `iduser`=:id";
                                    $resultado = $conection->prepare($sql);
                                    $resultado->bindValue(":foto", $targetFile);
                                    $resultado->bindValue(":id", $idu);
                                    $resultado->execute();


                                } else{
                                    echo "Hubo un error al subir el archivo";
                                }
                            }
                            else{

                            }
                        }
                        else{
                            echo "La imagen es demasiado grande";
                        }
                    
                    }
                    else{
                        echo "No existe archivo";
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