<?php
require '../../Modelo/modelo_realizarexamen.php';

$MU= new modelo_realizarexamen(); //Instaciamos

$consultar=$MU->listar_realizarexamen();

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
