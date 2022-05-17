<?php

require '../../Modelo/modelo_examen.php';

$MU= new modelo_rol(); //Instaciamos
$idExamen=  htmlspecialchars($_POST['idExamen'], ENT_QUOTES, 'UTF-8');
$examen= strtoupper(htmlspecialchars($_POST['examen'], ENT_QUOTES, 'UTF-8'));
$idAnalisis= htmlspecialchars($_POST['ana'], ENT_QUOTES, 'UTF-8');
$estatus= strtoupper(htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8'));

$consultar=$MU->modificar_examen($idExamen,$examen,$idAnalisis,$estatus);

echo json_encode($consultar);

?>