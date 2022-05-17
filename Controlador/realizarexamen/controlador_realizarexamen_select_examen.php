<?php
require '../../Modelo/modelo_realizarexamen.php';

$MU = new modelo_realizarexamen(); //Instaciamos



$ana=  htmlspecialchars($_POST['idana'], ENT_QUOTES, 'UTF-8');
$consultar = $MU->listar_realizarexamen_select_examen($ana);
echo json_encode($consultar);
