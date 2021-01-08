<?php

    $host= $_SERVER["HTTP_HOST"];

    if(strcmp($host, "localhost") === 0){
        
        $server = "localhost";
        $user ="root";
        $password = "";
        $bd = "todolist";
    }
    else{
        $server = "bf7fhdjnbgbxcab3jzmo-mysql.services.clever-cloud.com";
        $user ="u309jjiooh9s454g";
        $password = "1WAOBnaOWKBX6dEnpe5P";
        $bd = "bf7fhdjnbgbxcab3jzmo";
    }  

?>