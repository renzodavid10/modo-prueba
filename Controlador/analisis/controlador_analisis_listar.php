<?php
require '../../Modelo/modelo_analisis.php';

$MU= new modelo_rol(); //Instaciamos

$consultar=$MU->listar_analisis();

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