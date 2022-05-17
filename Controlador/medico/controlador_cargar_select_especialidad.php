<?php
require '../../Modelo/modelo_medico.php';

$MU = new modelo_medico(); //Instaciamos

$consultar = $MU->listar_select_especialidad();


echo json_encode($consultar);
