<?php
include("db.php");
$usuario=$_POST['user'];
$contraseña=$_POST['pass'];
session_start();
$_SESSION['user']=$usuario;

#nombre del server: localhost
#usuario: root
#contraseña: 
#nombre de la BBDD: todolist

$conexion=mysqli_connect("localhost","root","","todolist");

$consulta="SELECT * FROM usuarios where username='$usuario' and password='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
  
    header("location:../../index.html");

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