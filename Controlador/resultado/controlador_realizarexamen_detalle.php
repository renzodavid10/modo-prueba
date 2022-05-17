<?php
require '../../Modelo/modelo_resultadoexamen.php';

$MU= new modelo_resultadoexamen(); //Instaciamos

$id = htmlspecialchars($_POST['idexamen'], ENT_QUOTES, 'UTF-8');
$consultar=$MU->listar_resultadoexamen_detalle($id);

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