<?php

require_once 'modelo_conexion.php';

class modelo_especialidad extends conexion
{
    public function listar_especialidad()
    {

        $c = conexion::conectarBD();

        $sql = "SELECT * FROM sp_listar_especialidad()";

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
    function registrar_especialidad($esp)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  sp_registrar_especialidad(?) ";


        $query = $c->prepare($sql);

        $query->bindParam(1, $esp);
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

    function editar_especialidad($id,$esp,$status){
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  sp_modificar_especialidad(?,?,?) ";


        $query = $c->prepare($sql);

        $query->bindParam(1, $id);
        $query->bindParam(2, $esp);
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
