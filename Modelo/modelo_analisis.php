<?php

require_once 'modelo_conexion.php';

class modelo_rol extends conexion
{
  public function listar_analisis()
  {

    $c = conexion::conectarBD();

    $sql = "SELECT * FROM  sp_listar_analisis()";

    $arreglo = array();
    $query = $c->prepare($sql);
    $query->execute();

    $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultado as $resu) {
      $arreglo["data"][] = $resu;
    }
    return $arreglo;

    conexion::cerrar_conexion();
  }
  
  function agregar_analisis($ana)
  {

    $c = conexion::conectarBD();

    $sql = "SELECT *FROM  registrar_analisis(?) ";


    $query = $c->prepare($sql);

    $query->bindParam(1, $ana);
    $query->execute();
    //solo se utiliza cuando no retornas un valor en el procedure

    /* if ($resultado == 1) {
    return 5;
  } else {
    return 0;
  }-*/
    if ($row = $query->fetchColumn()) {
      return $row;
    }

    conexion::cerrar_conexion();
  }
  function editar_analisis($idAnalisis,$analisis,$estatus){
    $c = conexion::conectarBD();

    $sql = "SELECT *FROM  editar_analisis(?,?,?) ";


    $query = $c->prepare($sql);

    $query->bindParam(1, $idAnalisis);
    $query->bindParam(2, $analisis);
    $query->bindParam(3, $estatus);
    $query->execute();
    //solo se utiliza cuando no retornas un valor en el procedure

    /* if ($resultado == 1) {
    return 5;
  } else {
    return 0;
  }-*/
    if ($row = $query->fetchColumn()) {
      return $row;
    }

    conexion::cerrar_conexion();

  }
}

/*$llamar = new modelo_usu;

$llamar->listar_select_rol();
$hola=$llamar->modificar_usu(2, 'agmail.com', 1);
echo $hola;*/
