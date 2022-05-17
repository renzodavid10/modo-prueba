<?php
require '../../Modelo/modelo_rol.php';



$MU = new modelo_rol; //Instaciamos
$idrol = htmlspecialchars($_POST['idrol'], ENT_QUOTES, 'UTF-8');
$rol = htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8');
$status = htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8');

$consultar = $MU->editar_rol($idrol,$rol,$status);


echo $consultar;