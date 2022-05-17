<?php

require_once 'modelo_conexion.php';

class modelo_usu extends conexion
{

  public function VerificarUsuario($usuario, $pass)
  {

    $c = conexion::conectarBD();

    $sql = "SELECT * FROM  verificar_usuario(?)";

    $arreglo = array();
    $query = $c->prepare($sql);
    $query->bindParam(1, $usuario); /// para que la primer entrada de la setencia sql reciba un dato
    $query->execute();

    $resultado = $query->fetchAll();
    //$nuevo="";

    foreach ($resultado as $resu) {
      if (password_verify($pass, $resu['usu_contrasena'])) { // PHP brinda una funcion para poder verificar contraseñas ncriptadas ya que siempre estan cambiando
        $arreglo[] = $resu;
      }
    }

    //echo strlen($nuevo);/// contar en un string espacio.
    //$cumple =strpos($nuevo,$usuario); buscar string en la cadina -arroja el valor

    //echo substr($nuevo,$cumple,$suma);cadena de llama




    //return $resultado;
    return $arreglo;

    conexion::cerrar_conexion();
  }
  public function listar_usuario()
  {

    $c = conexion::conectarBD();

    $sql = "SELECT * FROM  listar_usuario()";

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

  public function listar_select_rol()
  {
    $c = conexion::conectarBD();

    $sql = "SELECT * FROM  sp_listar_rol()";

    $arreglo = array();
    $query = $c->prepare($sql);
    $query->execute();

    $resultado = $query->fetchAll();
    foreach ($resultado as $resu) {
      $arreglo[] = $resu;
    }
    //rint_r($arreglo);
    return $arreglo;

    conexion::cerrar_conexion();
  }
  public function registrar_usu($usuario, $contrasena, $rol, $email, $ruta)
  {
    $c = conexion::conectarBD();

    $sql = "SELECT *FROM  sp_registrar_usuario(?,?,?,?,?) ";


    $query = $c->prepare($sql);

    $query->bindParam(1, $usuario);
    $query->bindParam(2, $contrasena);
    $query->bindParam(3, $rol);
    $query->bindParam(4, $email);
    $query->bindParam(5, $ruta);
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
  function modificar_usu($id, $email, $rol)
  {
    $c = conexion::conectarBD();

    $sql = "SELECT sp_modificar_usuario(?,?,?) ";


    $query = $c->prepare($sql);

    $query->bindParam(1, $id);
    $query->bindParam(2, $email);
    $query->bindParam(3, $rol);
    $resultado = $query->execute();

    return $resultado;
    if ($resultado == 1) {
      return 1;
    } else {
      return 0;
    }
  }
  function modificar_usuario_status($id, $status)
  {
    $c = conexion::conectarBD();

    $sql = "SELECT sp_modificar_usuario_estatus(?,?) ";


    $query = $c->prepare($sql);

    $query->bindParam(1, $id);
    $query->bindParam(2, $status);

    $resultado = $query->execute();

    return $resultado;
    if ($resultado == 1) {
      return 1;
    } else {
      return 0;
    }
  }
  function modificar_usu_foto($id, $foto)
  {
    $c = conexion::conectarBD();

    $sql = "SELECT sp_modificar_usuario_foto(?,?) ";


    $query = $c->prepare($sql);

    $query->bindParam(1, $id);
    $query->bindParam(2, $foto);

    $resultado = $query->execute();

    return $resultado;
    if ($resultado == 1) {
      return 1;
    } else {
      return 0;
    }
  }
  function modificar_usuario_contra($id, $contraN){
    $c = conexion::conectarBD();

    $sql = "SELECT sp_modificar_usuario_contra(?,?) ";


    $query = $c->prepare($sql);

    $query->bindParam(1, $id);
    $query->bindParam(2, $contraN);

    $resultado = $query->execute();

    return $resultado;
    if ($resultado == 1) {
      return 1;
    } else {
      return 0;
    }
  }
}
/*$llamar = new modelo_usu;

$llamar->listar_select_rol();
$hola=$llamar->modificar_usu(2, 'agmail.com', 1);
echo $hola;*/
