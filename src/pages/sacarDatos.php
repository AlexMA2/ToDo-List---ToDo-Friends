<?php       
    function getInfoSobre($usuarioid){
        require "conexion.php";
        $sql = "SELECT * FROM `usuarios` WHERE `iduser` = :user";
        $resultado = $conection->prepare($sql);
        $resultado->bindValue(":user", $usuarioid);
         $resultado->execute();

        $filas = $resultado->rowCount();
        $datos = $resultado->fetch(PDO::FETCH_ASSOC);
        if($filas == 1){
            $uID = $datos["iduser"];
            $uNombre = $datos["username"];
            $uCorreo = $datos["correo"];
            $uFoto = $datos["Foto"];     
            return array($uID, $uNombre, $uCorreo, $uFoto); 
                        
        }
    }

    function getInfoSobreGrupo($grupoid){
        require "conexion.php";
        $sql = "SELECT * FROM `grupos` WHERE `IDGRUPO` = :grupo";
        $resultado = $conection->prepare($sql);
        $resultado->bindValue(":grupo", $grupoid);
         $resultado->execute();

        $filas = $resultado->rowCount();
        $datos = $resultado->fetch(PDO::FETCH_ASSOC);
        if($filas == 1){
            $gID = $datos["IDGRUPO"];
            $gNombre = $datos["Nombre"];
            $gDesc = $datos["Descripcion"];
            $gDueno = $datos["Dueno"];     
            return array($gID, $gNombre, $gDesc, $gDueno);       
        }
    }
    function getDatos($addEmail){
        require "conexion.php";
        $consulta="SELECT * FROM `usuarios` WHERE `correo` = :email";
        $resultadoSql=$conection->prepare($consulta);
        $resultadoSql->bindValue(":email", $addEmail);
        $resultadoSql->execute();
        

        $filas = $resultadoSql->rowCount();
        $datos = $resultadoSql->fetch(PDO::FETCH_ASSOC);
        if($filas == 1){
            $ID2 = $datos["iduser"];
            $Nombre2 = $datos["username"];
            $Correo2 = $datos["correo"];
            $Foto2 = $datos["Foto"];   
              
            return array($ID2, $Nombre2, $Correo2, $Foto2);       
        }
    }
    
?>