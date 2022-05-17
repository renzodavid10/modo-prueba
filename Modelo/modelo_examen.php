<?php

require_once 'modelo_conexion.php';

class modelo_rol extends conexion
{
    public function listar_examen()
    {

        $c = conexion::conectarBD();

        $sql = "SELECT * FROM  sp_listar_examen()";

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
    function listar_select_analisis()
    {
        $c = conexion::conectarBD();

        $sql = "SELECT * FROM  sp_listar_select_analisis()"; // solo regresa los activos
        //$sql = "SELECT * FROM  sp_listar_analisis()";// otra forma

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
    function registrar_examen($examen, $ana)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  registrar_examen(?,?) ";


        $query = $c->prepare($sql);

        $query->bindParam(1, $examen);
        $query->bindParam(2, $ana);
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
    function modificar_examen($idExamen, $examen, $ana, $estatus)
    {
        $c = conexion::conectarBD();

        $sql = "SELECT *FROM  modificar_examen(?,?,?,?) ";


        $query = $c->prepare($sql);
        $query->bindParam(1, $idExamen);
        $query->bindParam(2, $examen);
        $query->bindParam(3, $ana);
        $query->bindParam(4, $estatus);
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
