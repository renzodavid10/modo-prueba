<?php
require '../../Modelo/modelo_realizarexamen.php';

$MU = new modelo_realizarexamen(); //Instaciamos

$id =  htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$iexamen =  htmlspecialchars($_POST['iexamen'], ENT_QUOTES, 'UTF-8');
$ianalisis =  htmlspecialchars($_POST['ianalisis'], ENT_QUOTES, 'UTF-8');
$array_examen = explode(",",$iexamen);
$array_analisis= explode(",",$ianalisis);

for ($i=0; $i < count($array_examen) ; $i++) { 
    $consultar = $MU->registrar_realizarexamen_detalle($id,$array_examen[$i],$array_analisis[$i]);
}


echo $consultar;
