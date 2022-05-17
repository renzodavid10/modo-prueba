<?php
require '../../Modelo/modelo_analisis.php';

$MU= new modelo_rol(); //Instaciamos
$analisis= strtoupper(htmlspecialchars($_POST['ana'], ENT_QUOTES, 'UTF-8'));// convierte a mayusculas
$consultar=$MU->agregar_analisis($analisis);

echo $consultar;
?>