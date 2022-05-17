<?php
require '../../Modelo/modelo_usuario.php';
$ruta = "";

/*$contrasena = password_hash('123456', PASSWORD_DEFAULT, ['cost' => 12]);
echo ($contrasena);*/

$MU = new modelo_usu(); //Instaciamos
$usuario = htmlspecialchars($_POST['u'], ENT_QUOTES, 'UTF-8');
$contrasena = password_hash($_POST['c'], PASSWORD_DEFAULT, ['cost' => 12]);
$email = htmlspecialchars($_POST['e'], ENT_QUOTES, 'UTF-8');
$rol = htmlspecialchars($_POST['r'], ENT_QUOTES, 'UTF-8');
$nombrefoto = htmlspecialchars($_POST['nombreFoto'], ENT_QUOTES, 'UTF-8');
//$foto= htmlspecialchars($_POST['foto'],ENT_QUOTES,'UTF-8');

if (empty($nombrefoto)) {
    $ruta = 'Controlador/usuario/foto/default.png';
} else {
    $ruta = "Controlador/usuario/foto/".$nombrefoto;
}

$consultar = $MU->registrar_usu($usuario, $contrasena, $rol, $email, $ruta);


echo $consultar;
if ($consultar == 1) {
    if (!empty($nombrefoto)) {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], "foto/" . $nombrefoto));
    }
}
