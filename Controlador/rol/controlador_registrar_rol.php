<?php
require '../../Modelo/modelo_rol.php';



$MU = new modelo_rol; //Instaciamos
$rol = htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8');

$consultar = $MU->registrar_rol($rol);


echo $consultar;