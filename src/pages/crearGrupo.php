<?php 
    require 'conexion.php';
    session_start();
    $titulo_grupo = filter_input(INPUT_POST, 'Titulo4', FILTER_SANITIZE_SPECIAL_CHARS);
    $descripcion_grupo = filter_input(INPUT_POST, 'Descripcion4', FILTER_SANITIZE_SPECIAL_CHARS);
    if(strlen($titulo_grupo) > 128 || strlen($titulo_grupo) < 4){
        print_r("Error: El título del grupo debe tener entre 4 caracteres y 256 caracteres");
    }
    else if(strlen($descripcion_grupo) > 256){
        print_r("Error: La descripcion del grupo debe tener menos de 256 caracteres");
    }
    else{
        try{       
            print_r("Aceptado");     
            $sql = "INSERT INTO `grupos`(`Nombre`, `Descripcion`, `Dueno`, `Creacion`) VALUES (:nombre, :descrip, :dueno, :creac)";
            $tabla = $conection->prepare($sql);
            $tabla->bindValue(":nombre", $titulo_grupo);
            $tabla->bindValue(":descrip", $descripcion_grupo);
            $tabla->bindValue(":dueno", $_SESSION['user']);
            $tabla->bindValue(":creac", date('Y-m-d'));
            $tabla->execute();
        }
        catch(Exception $ex){                
           print_r("Error: No fue posible comunicarse con la base de datos");
        }
    }

   
?>