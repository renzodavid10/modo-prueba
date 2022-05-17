<?php
require '../../Modelo/modelo_rol.php';

$MU= new modelo_rol(); //Instaciamos

$consultar=$MU->listar_rol();

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