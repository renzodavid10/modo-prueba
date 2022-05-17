<?php

require_once 'modelo_conexion.php';

class modelo_realizarexamen extends conexion
{
    public function listar_realizarexamen()
    {

        $c = conexion::conectarBD();

        $sql = "SELECT * FROM sp_listar_realiza_examen()";

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
    function listar_realizarexamen_select_examen($ana)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT * FROM sp_listar_select_examen(?)";

        $arreglo = array();
        $query = $c->prepare($sql);
        $query->bindParam(1, $ana);
        $query->execute();

        $resultado = $query->fetchAll();
        foreach ($resultado as $resu) {
            $arreglo[] = $resu;
        }
        return $arreglo;

        conexion::cerrar_conexion();
    }
    function registrar_realizarexamen($idpa, $idusu, $idmedico)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  sp_registrar_realizarexamendos(?,?,?) ";


        $query = $c->prepare($sql);


        $query->bindParam(1, $idpa);
        $query->bindParam(2, $idusu);
        $query->bindParam(3, $idmedico);
        
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
    function registrar_realizarexamen_detalle($i,$array_examen,$array_analisi){
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  sp_registrar_detalle_realizarexamen(?,?,?) ";


        $query = $c->prepare($sql);


        $query->bindParam(1, $i);
        $query->bindParam(2, $array_examen);
        $query->bindParam(3, $array_analisi);
        
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
