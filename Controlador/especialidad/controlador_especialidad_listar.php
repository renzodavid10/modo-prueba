<?php
require '../../Modelo/modelo_especialidad.php';

$MU = new modelo_especialidad(); //Instaciamos

$consultar = $MU->listar_especialidad();

if (count($consultar) > 0) {
    echo json_encode($consultar);
} else {
    echo '{
       "sEcho": 1,
       "iTotalRecords":"0",
       "iTotalDisplayRecords":"0",
       "aaData":[]
   }';
}
