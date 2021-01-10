<?php 
    require 'conexion.php';
    session_start();
    if(!empty(filter_input(INPUT_POST, 'CrearGrupo'))){
        $titulo_grupo = filter_input(INPUT_POST, 'Titulo4');
        if(!empty($titulo_grupo)){
            try{
                $descripcion_grupo = filter_input(INPUT_POST, 'Descripcion4');
                $sql = "INSERT INTO `grupos`(`Nombre`, `Descripcion`, `Dueno`, `Creacion`) VALUES (:nombre, :descrip, :dueno, :creac)";
                $tabla = $conection->prepare($sql);
                $tabla->bindValue(":nombre", $titulo_grupo);
                $tabla->bindValue(":descrip", $descripcion_grupo);
                $tabla->bindValue(":dueno", $_SESSION['user']);
                $tabla->bindValue(":creac", date('Y-m-d'));
                $tabla->execute();
                

            }
            catch(Exception $ex){                
               
            }

        }
    }

    header("Location: MisEquipos");
   
?>