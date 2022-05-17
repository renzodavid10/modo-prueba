<?php
require '../../Modelo/modelo_especialidad.php';



$MU = new modelo_especialidad; //Instaciamos
$esp = htmlspecialchars($_POST['espe'], ENT_QUOTES, 'UTF-8');

$consultar = $MU->registrar_especialidad($esp);


echo $consultar;