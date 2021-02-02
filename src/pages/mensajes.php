<?php
    require "conexion.php";
    require "sacarDatos.php";
    session_start();    

    $hacer = filter_input(INPUT_POST, 'do');

    if(!empty($hacer) && !empty($_SESSION['user']) && !empty($_SESSION['grupo'])){
        if($hacer === "enviar"){
            $msj = filter_input(INPUT_POST, 'msj');    
        
            $sql = "INSERT INTO `mensaje` (`Emisor`, `Receptor`, `Mensaje`, `Hora`) VALUES (:emisor,:receptor, :mensaje, :hora)";
            
            $tabla = $conection->prepare($sql);
            $tabla->bindValue(":emisor", $_SESSION['user']);
            $tabla->bindValue(":receptor", $_SESSION['grupo']);
            $tabla->bindValue(":mensaje", $msj);
            $tabla->bindValue(":hora", date('d/m/Y H:i'));
            $tabla->execute();
    
        }
        else if($hacer === "actualizar"){        
            $len= filter_input(INPUT_POST, 'length');    
        
            $sql = "SELECT * FROM `mensaje` WHERE `Receptor` = :receptor";
            
            $tabla = $conection->prepare($sql);        
            $tabla->bindValue(":receptor", $_SESSION['grupo']);        
            $tabla->execute();
    
            $matriz = [];
            $nuevaFila = [];
            $cntdr = 1;
    
            while($datos = $tabla->fetch(PDO::FETCH_ASSOC)){
                if($len < $cntdr){
                    $nuevaFila["mensaje"] = $datos["Mensaje"];
                    $nuevaFila["fecha"] = $datos["Hora"];
                    $nuevaFila["nombre"] = getInfoSobre($datos["Emisor"])[1];
                    $nuevaFila["foto"] = getInfoSobre($datos["Emisor"])[3];
                    array_push($matriz, $nuevaFila);   
                }                   
                $cntdr++;
            }
    
            if($cntdr - $len <= 1){
                echo "NO";
            }
            else if($cntdr - $len > 1){
                echo json_encode($matriz);
            }
            
            
    
        }
        else if($hacer === "eliminar"){
            $sql = "DELETE FROM `mensaje` WHERE `Receptor` = :receptor";
            
            $tabla = $conection->prepare($sql);        
            $tabla->bindValue(":receptor", $_SESSION['grupo']);        
            $tabla->execute();

        }
    }   

    
?>