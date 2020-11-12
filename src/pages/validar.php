<?php
include("db.php");
$usuario=$_POST['u'];
$contraseña=$_POST['p'];
session_start();
$_SESSION['u']=$usuario;


$conexion=mysqli_connect("localhost","root","","bbdd");

$consulta="SELECT * FROM registro where usuario='$usuario' and contrasena='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
  
    header("location:nosotros.html");

}else{
    ?>
    <?php
    include("login.html");
  ?>
  <h1>ERROR DE AUTENTIFICACION</h1>
  <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);