<?php
require '../../Modelo/modelo_resultadoexamen.php';

$MU= new modelo_resultadoexamen(); //Instaciamos

$consultar=$MU->listar_resultado();

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