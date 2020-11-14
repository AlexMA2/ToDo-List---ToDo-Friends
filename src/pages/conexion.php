<?php
    define('DB_SERVER', 'local_host');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'todofriends');

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if($link === false){
        die("Error en la conexión.", mysqli_connect_error());
    }
?>