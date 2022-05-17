<?php
require '../../Modelo/modelo_analisis.php';

$MU= new modelo_rol(); //Instaciamos
$idAnalisis= htmlspecialchars($_POST['idAna'], ENT_QUOTES, 'UTF-8');
$analisis= htmlspecialchars($_POST['ana'], ENT_QUOTES, 'UTF-8');
$estatus= htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8');
$consultar=$MU->editar_analisis($idAnalisis,$analisis,$estatus);

echo $consultar;
?>