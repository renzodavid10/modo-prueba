<?php

require_once 'modelo_conexion.php';

class modelo_rol extends conexion
{
    public function listar_rol()
    {

        $c = conexion::conectarBD();

        $sql = "SELECT * FROM  sp_listar_rol()";

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
    function registrar_rol($rol)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  sp_registrar_rol(?) ";


        $query = $c->prepare($sql);

        $query->bindParam(1, $rol);
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
    function editar_rol($idrol, $rol, $status)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT modificar_rol(?,?,?) ";


        $query = $c->prepare($sql);

        $query->bindParam(1, $idrol);
        $query->bindParam(2, $rol);
        $query->bindParam(3, $status);
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
