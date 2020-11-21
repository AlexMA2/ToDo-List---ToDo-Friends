<?php
#include("db.php");
$usuario=$_POST['user'];
$contraseña=$_POST['pass'];
session_start();
$_SESSION['user']=$usuario;

#nombre del server: localhost
#usuario: root
#contraseña: 
#nombre de la BBDD: todolist

$conexion=mysqli_connect("localhost","root","","todolist");

#nombre de la tabla: usuarios

$consulta="SELECT * FROM usuarios where username='$usuario' and password='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
    #si logra ingresar, se dirigira a: index.html
    header("location:NetWork.php");

}else{
    ?>
    <?php
    #se redirigirá a la misma página, pero con una señal de error
    include("login.html");
  ?><p/p>
  <h1 align="center">USUARIO NO REGISTRADO</h1>
  <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);