<?php
    include('config.php');
    #nombre del server: localhost
    #usuario: root
    #contraseña: 
    #nombre de la BBDD: todolist

    #registro php
    $conection = new mysqli($server, $user, $password, $bd);
    if (mysqli_connect_errno()){
        echo "No Conectado bro, sorry", mysqli_connect_error();
        exit();
    }
?>