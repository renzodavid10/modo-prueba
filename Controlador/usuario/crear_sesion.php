<?php 

$id_usu= htmlspecialchars($_POST['id_usu'],ENT_QUOTES,'UTF-8');// ENT:QUOTE .. para saltar codigo o innyecciones js
$usuario= htmlspecialchars($_POST['usuario'],ENT_QUOTES,'UTF-8');
$rol= htmlspecialchars($_POST['rol'],ENT_QUOTES,'UTF-8');

session_start();//inicio sesion
$_SESSION['S_IDUSUARIO']=$id_usu;
$_SESSION['S_USUARIO']=$usuario;
$_SESSION['S_ROL']=$rol;


?>