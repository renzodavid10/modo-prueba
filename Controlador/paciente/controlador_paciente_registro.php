<?php
require '../../Modelo/modelo_paciente.php';

$MU = new modelo_paciente(); //Instaciamos
$contador = 0;
$error = "";

$dni =  htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8');
$nombre = strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
$aPat =  strtoupper(htmlspecialchars($_POST['aPat'], ENT_QUOTES, 'UTF-8'));
$aMat = strtoupper(htmlspecialchars($_POST['aMat'], ENT_QUOTES, 'UTF-8'));
$celular = htmlspecialchars($_POST['celular'], ENT_QUOTES, 'UTF-8');
$edad = htmlspecialchars($_POST['edad'], ENT_QUOTES, 'UTF-8');
$tipo =  strtoupper(htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8'));
$genero = strtoupper(htmlspecialchars($_POST['genero'], ENT_QUOTES, 'UTF-8'));
//Para solo letras
if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $nombre)) {
    $contador++;
    $error .= "El nombre del paciente debe contener solo letras.<br>";
}

if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $aPat)) {
    $contador++;
    $error .= "El apellido paterno del paciente debe contener solo letras.<br>";
}

if (!preg_match("/^(?!-+)[a-zA-Z-ñáéíóú\s]*$/", $aMat)) {
    $contador++;
    $error .= "El apellido materno del paciente debe contener solo letras.<br>";
}

//Para solo números
if (!preg_match("/^[[:digit:]\s]*$/", $celular)) {
    $contador++;
    $error .= "El celular del paciente debe contener solo números.<br>";
}

if (!preg_match("/^[[:digit:]\s]*$/", $edad)) {
    $contador++;
    $error .= "La edad del paciente debe contener solo números.<br>";
}
if (!preg_match("/^[[:digit:]\s]*$/", $dni)) {
    $contador++;
    $error .= "La edad del paciente debe contener solo números.<br>";
}
if ($contador > 0) {
    echo $error;
} else {
    $consulta = $MU->Registrar_paciente($dni, $nombre, $aPat, $aMat, $celular, $edad, $tipo, $genero);
    echo $consulta;
}
