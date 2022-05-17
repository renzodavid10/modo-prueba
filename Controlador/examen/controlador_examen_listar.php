<?php
require '../../Modelo/modelo_examen.php';

$MU= new modelo_rol(); //Instaciamos

$consultar=$MU->listar_examen();

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