<?php
require '../../Modelo/modelo_usuario.php';
$ruta = "";


$MU = new modelo_usu(); //Instaciamos
$id= htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$nombrefoto = htmlspecialchars($_POST['nombreFoto'], ENT_QUOTES, 'UTF-8');
$rutaactual = htmlspecialchars($_POST['rutaactual'], ENT_QUOTES, 'UTF-8');
//$foto= htmlspecialchars($_POST['foto'],ENT_QUOTES,'UTF-8');

if (empty($nombrefoto)) {
    $ruta = 'Controlador/usuario/foto/default.png';
} else {
    $ruta = "Controlador/usuario/foto/".$nombrefoto;
}

$consultar = $MU->modificar_usu_foto($id,$ruta);
echo $consultar.$rutaactual;

if ($consultar == 1) {
    if (!empty($nombrefoto)) {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], "foto/" . $nombrefoto));
        if(strlen($rutaactual)!=0 && $rutaactual!="Controlador/usuario/foto/default.png"){//longiud
            unlink("../../".$rutaactual);
        }
        
    }
}

