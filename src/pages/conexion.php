<?php
    include('config.php');
    #nombre del server: localhost
    #usuario: root
    #contraseña: 
    #nombre de la BBDD: todolist
    # $server, $user, $password, $bd
    #registro php
    try{
        $conection = new PDO("mysql:host=$server; dbname=$bd", $user, $password);
        $conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $ex){
        die("Error al conectar:  $e->getMessage()");
    }

    
   
?>