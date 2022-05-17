<?php
require '../../Modelo/modelo_paciente.php';

$MU= new modelo_paciente(); //Instaciamos

$consultar=$MU->listar_paciente();

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

?>