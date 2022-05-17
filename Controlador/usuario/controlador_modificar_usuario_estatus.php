<?php
require '../../Modelo/modelo_usuario.php';



$MU = new modelo_usu; //Instaciamos
$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$status= htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8');

//$foto= htmlspecialchars($_POST['foto'],ENT_QUOTES,'UTF-8');


$consultar = $MU->modificar_usuario_status($id,$status);


echo $consultar;