<?php
require '../../Modelo/modelo_medico.php';

$MU= new modelo_medico(); //Instaciamos

$consultar=$MU->listar_medico();

if(count($consultar)>0){
   echo json_encode($consultar);
}else{
   echo '{
       "sEcho": 1,
       "iTotalRecords":"0",
       "iTotalDisplayRecords":"0",
       "aaData":[]
   }';
}
