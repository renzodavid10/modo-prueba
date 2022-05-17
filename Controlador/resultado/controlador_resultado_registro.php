<?php
require '../../Modelo/modelo_resultadoexamen.php';

$MU= new modelo_resultadoexamen(); //Instaciamos

$idrea = htmlspecialchars($_POST['idRealizarExamen'], ENT_QUOTES, 'UTF-8');
$idusu = htmlspecialchars($_POST['idUsuario'], ENT_QUOTES, 'UTF-8');

$consultar=$MU->listar_registrar_resultado($idrea,$idusu);

echo $consultar;
