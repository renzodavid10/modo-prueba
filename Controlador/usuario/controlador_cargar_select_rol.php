<?php

require '../../Modelo/modelo_usuario.php';

$MU= new modelo_usu(); //Instaciamos

$consultar=$MU->listar_select_rol();

   echo json_encode($consultar);

?>