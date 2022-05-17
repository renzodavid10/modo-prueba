<?php
require_once 'modelo_conexion.php';

class modelo_resultadoexamen extends conexion
{
    public function listar_resultado()
    {

        $c = conexion::conectarBD();

        $sql = "SELECT * FROM listar_resultado()";

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
    function listar_resultadopaciente_pendiente()
    {
        $c = conexion::conectarBD();

        $sql = "SELECT * FROM sp_listar_realiza_examen_pendiente()";

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

    function listar_resultadoexamen_detalle($id)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT * FROM listar_detalle_analisis_resultado(?)";

        $arreglo = array();
        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();

        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $resu) {
            $arreglo["data"][] = $resu;
        }
        return $arreglo;

        conexion::cerrar_conexion();
    }
    function listar_registrar_resultado($idrea, $idusu)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  registrar_resultado_examen(?,?) ";


        $query = $c->prepare($sql);


        $query->bindParam(1, $idrea);
        $query->bindParam(2, $idusu);
       
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
