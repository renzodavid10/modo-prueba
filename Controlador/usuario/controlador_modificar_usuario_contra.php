<?php
require '../../Modelo/modelo_usuario.php';



$MU = new modelo_usu; //Instaciamos
$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$contraN = password_hash($_POST['nueva'], PASSWORD_DEFAULT, ['cost' => 12]);;

//$foto= htmlspecialchars($_POST['foto'],ENT_QUOTES,'UTF-8');


$consultar = $MU->modificar_usuario_contra($id, $contraN);


echo $consultar;
