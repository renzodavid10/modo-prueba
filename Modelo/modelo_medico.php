<?php

require_once 'modelo_conexion.php';

class modelo_medico extends conexion
{
    public function listar_medico()
    {

        $c = conexion::conectarBD();

        $sql = "SELECT * FROM sp_listar_medico()";

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
    function listar_select_especialidad()
    {
        $c = conexion::conectarBD();

        $sql = "SELECT * FROM sp_listar_select_especialidad()";

        $arreglo = array();
        $query = $c->prepare($sql);
        $query->execute();

        $resultado = $query->fetchAll();
        foreach ($resultado as $resu) {
            $arreglo[] = $resu;
        }
        return $arreglo;

        conexion::cerrar_conexion();
    }
    function registar_medico(
        $dni,
        $nombre,
        $aPat,
        $aMat,
        $celular,
        $dire,
        $fNa,
        $espec,
        $usuario,
        $contrasena,
        $rol,
        $email,
        $ruta
    ) {
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  sp_registrar_medico(?,?,?,?,?,?,?,?,?,?,?,?,?) ";


        $query = $c->prepare($sql);

        $query->bindParam(1, $dni);
        $query->bindParam(2, $nombre);
        $query->bindParam(3, $aPat);
        $query->bindParam(4, $aMat);
        $query->bindParam(5, $celular);
        $query->bindParam(6, $espec);
        $query->bindParam(7, $fNa);
        $query->bindParam(8, $dire);
        $query->bindParam(9, $usuario);
        $query->bindParam(10, $contrasena);
        $query->bindParam(11, $rol);
        $query->bindParam(12, $email);
        $query->bindParam(13, $ruta);
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
    function modificar_medico(
        $idM,
        $dni,
        $nombre,
        $aPat,
        $aMat,
        $espec,
        $celular,
        $fNa,
        $dire,
        $idusuario,
        $usuario,
        $email,
        $rol
    ) {
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  sp_modificar_medico(?,?,?,?,?,?,?,?,?,?,?,?,?) ";


        $query = $c->prepare($sql);

        $query->bindParam(1, $idM);
        $query->bindParam(2, $dni);
        $query->bindParam(3, $nombre);
        $query->bindParam(4, $aPat);
        $query->bindParam(5, $aMat);
        $query->bindParam(6, $espec);
        $query->bindParam(7, $celular);
        $query->bindParam(8, $fNa);
        $query->bindParam(9, $dire);
        $query->bindParam(10, $idusuario);
        $query->bindParam(11, $usuario);
        $query->bindParam(12, $email);
        $query->bindParam(13, $rol);
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
