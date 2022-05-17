<?php
require '../../Modelo/modelo_realizarexamen.php';

$MU = new modelo_realizarexamen(); //Instaciamos

$idpa =  htmlspecialchars($_POST['idPaciente'], ENT_QUOTES, 'UTF-8');
$idusu =  htmlspecialchars($_POST['idUsuario'], ENT_QUOTES, 'UTF-8');
$idmedico =  htmlspecialchars($_POST['idmedico'], ENT_QUOTES, 'UTF-8');
$consultar = $MU->registrar_realizarexamen($idpa,$idusu,$idmedico);
echo $consultar;
