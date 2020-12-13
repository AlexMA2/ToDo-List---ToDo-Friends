<?php
 if(isset($_POST["registrar"])){
     if(!empty($_POST['correo'])){
        $correo = htmlentities(addslashes($_POST["correo"]));
         $usuario= htmlentities(addslashes($_POST['user']));
         $asunto="Correo de verificacion";
         $header.="reply-To: suport@todolist.com"."\r\n";
         $header.="X.Mailer: PHP/". phpversion();
        $msg="Usted se ha registrado en Todo List. "."\r\n";
        $msg="Si usted no realizó la operacion, contactese con nosotros. ";
        
        $mail= mail($correo,$asunto,$msg,$header);
        
        if(isset($mail)){
           
        }else{
            echo"<h4>error en correo </h4>";
        }

     }
 }
 ?> 