<?php
include("config.php");
$conection = new mysqli($server, $user, $password, $bd);
if (mysqli_connect_errno()){
    echo "No Conectado bro, sorry", mysqli_connect_error();
    exit();
}//else{
 //   echo "Conectado p lok0";
//}
?>