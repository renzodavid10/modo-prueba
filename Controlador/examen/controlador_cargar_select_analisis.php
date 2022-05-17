<?php

require '../../Modelo/modelo_examen.php';

$MU= new modelo_rol(); //Instaciamos
$consultar=$MU->listar_select_analisis();

echo json_encode($consultar);

?>