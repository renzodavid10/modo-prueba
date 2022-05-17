<?php
require '../../Modelo/modelo_usuario.php';



$MU = new modelo_usu; //Instaciamos
$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$rol= htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
//$foto= htmlspecialchars($_POST['foto'],ENT_QUOTES,'UTF-8');


$consultar = $MU->modificar_usu($id,$email,$rol);


echo $consultar;
