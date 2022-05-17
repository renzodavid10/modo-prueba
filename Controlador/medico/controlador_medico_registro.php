<?php
require '../../Modelo/modelo_medico.php';
$ruta = "";

//datosdel usu
$MU = new modelo_medico(); //Instaciamos
$usuario = htmlspecialchars($_POST['u'], ENT_QUOTES, 'UTF-8');
$contrasena = password_hash($_POST['c'], PASSWORD_DEFAULT, ['cost' => 12]);
$email = htmlspecialchars($_POST['e'], ENT_QUOTES, 'UTF-8');
$rol = htmlspecialchars($_POST['r'], ENT_QUOTES, 'UTF-8');
$nombrefoto = htmlspecialchars($_POST['nombreFoto'], ENT_QUOTES, 'UTF-8');
//$foto= htmlspecialchars($_POST['foto'],ENT_QUOTES,'UTF-8');
if (empty($nombrefoto)) {
    $ruta = '/Controlador/usuario/foto/default.png';
} else {
    $ruta = "/Controlador/usuario/foto/" . $nombrefoto;
}
//datos del medico

$contador = 0;
$error = "";
//$id = $dni =  htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$dni =  htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8');
$nombre = strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
$aPat =  strtoupper(htmlspecialchars($_POST['ape'], ENT_QUOTES, 'UTF-8'));
$aMat = strtoupper(htmlspecialchars($_POST['ama'], ENT_QUOTES, 'UTF-8'));
$celular = htmlspecialchars($_POST['cel'], ENT_QUOTES, 'UTF-8');
$dire = htmlspecialchars($_POST['direc'], ENT_QUOTES, 'UTF-8');
$fNa =  htmlspecialchars($_POST['fNa'], ENT_QUOTES, 'UTF-8');
$espec = htmlspecialchars($_POST['espec'], ENT_QUOTES, 'UTF-8');

//validaciones medico
//Para solo letras
if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $nombre)) {
    $contador++;
    $error .= "El nombre del MEDICO debe contener solo letras.<br>";
}

if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $aPat)) {
    $contador++;
    $error .= "El apellido paterno del MEDICO debe contener solo letras.<br>";
}

if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $aMat)) {
    $contador++;
    $error .= "El apellido materno del MEDICO debe contener solo letras.<br>";
}

//Para solo números
if (!preg_match("/^[[:digit:]\s]*$/", $celular)) {
    $contador++;
    $error .= "El celular del MEDICO debe contener solo números.<br>";
}

if (!preg_match("/^[[:digit:]\s]*$/", $dni)) {
    $contador++;
    $error .= "La edad del MEDICO debe contener solo números.<br>";
}
if ($contador > 0) {
    echo $error;
} else {
   $consulta = $MU->registar_medico($dni, $nombre, $aPat, $aMat, $celular, $dire, $fNa,$espec
    ,$usuario, $contrasena, $rol, $email, $ruta);
    echo $consulta;
    if ($consulta == 1) {
        if (!empty($nombrefoto)) {
            if (move_uploaded_file($_FILES['foto']['tmp_name'], "../usuario/foto/" . $nombrefoto));
        }
    }
    
    //echo 1;
}


