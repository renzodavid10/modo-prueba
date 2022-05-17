<?php

require '../../Modelo/modelo_examen.php';

$MU= new modelo_rol(); //Instaciamos
$ana=  htmlspecialchars($_POST['idAna'], ENT_QUOTES, 'UTF-8');
$examen= strtoupper(htmlspecialchars($_POST['examen'], ENT_QUOTES, 'UTF-8'));


$consultar=$MU->registrar_examen($examen,$ana);

echo json_encode($consultar);

?>