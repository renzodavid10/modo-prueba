<?php

require_once 'modelo_conexion.php';

class modelo_paciente extends conexion
{
    public function listar_paciente()
    {

        $c = conexion::conectarBD();

        $sql = "SELECT * FROM sp_listar_paciente()";

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
    function Registrar_paciente($dni, $nombres, $aPat, $aMat, $celular, $edad, $tipo, $genero)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  sp_registrar_paciente(?,?,?,?,?,?,?,?) ";


        $query = $c->prepare($sql);


        $query->bindParam(1, $dni);
        $query->bindParam(2, $nombres);
        $query->bindParam(3, $aPat);
        $query->bindParam(4, $aMat);
        $query->bindParam(5, $celular);
        $query->bindParam(6, $edad);
        $query->bindParam(7, $tipo);
        $query->bindParam(8, $genero);
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
    function editar_paciente($id,$dni, $nombre, $aPat, $aMat, $celular, $edad, $tipo, $genero)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  sp_modificar_paciente(?,?,?,?,?,?,?,?,?) ";


        $query = $c->prepare($sql);

        $query->bindParam(1, $id);
        $query->bindParam(2, $dni);
        $query->bindParam(3, $nombre);
        $query->bindParam(4, $aPat);
        $query->bindParam(5, $aMat);
        $query->bindParam(6, $celular);
        $query->bindParam(7, $edad);
        $query->bindParam(8, $tipo);
        $query->bindParam(9, $genero);
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }

        conexion::cerrar_conexion();
    }
}

