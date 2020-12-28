<?php 
    require 'conexion.php';
    session_start();
    if(!empty(filter_input(INPUT_POST, 'CrearGrupo'))){
        $titulo_grupo = filter_input(INPUT_POST, 'Titulo4');
        if(!empty($titulo_grupo)){
            try{
                $descripcion_grupo = filter_input(INPUT_POST, 'Descripcion4');
                $sql = "INSERT INTO `grupos`(`Nombre`, `Descripcion`, `Dueno`) VALUES (:nombre, :descrip, :dueno)";
                $tabla = $conection->prepare($sql);
                $tabla->bindValue(":nombre", $titulo_grupo);
                $tabla->bindValue(":descrip", $descripcion_grupo);
                $tabla->bindValue(":dueno", $_SESSION['user']);
                $tabla->execute();
            }
            catch(Exception $ex){
                echo "Error: ".$ex->getMessage();
                echo "</br>".$_SESSION['user'];
                echo "</br>".$descripcion_grupo;
                echo "</br>".$titulo_grupo;
            }
            

        }
    }
    header("Location: misequipos");
?>