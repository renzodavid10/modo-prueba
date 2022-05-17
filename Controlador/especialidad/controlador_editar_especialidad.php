<?php
require '../../Modelo/modelo_especialidad.php';



$MU = new modelo_especialidad; //Instaciamos
$id = htmlspecialchars($_POST['idespe'], ENT_QUOTES, 'UTF-8');
$esp = htmlspecialchars($_POST['espe'], ENT_QUOTES, 'UTF-8');
$status = htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8');

$consultar = $MU->editar_especialidad($id,$esp,$status);


echo $consultar;