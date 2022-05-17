<?php

class conexion
{

    private $host = 'localhost';
    private $dbname = 'labora';
    private $usuario = 'postgres';
    private $password = 'root';

    private $pdo;


    public function conectarBD()
    {

        try {
            $this->pdo = new PDO("pgsql:host=$this->host;dbname=$this->dbname", $this->usuario, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES 'UTF8'");
            //echo "Conexión Lista";
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Falló la conexión" . $e;
        }
    }
    public function cerrar_conexion(){
        $this->pdo=null;
    }

    public function ejecutar($sql) //inserta/delete/actualizar
    {
        $this->pdo->exec($sql);

        //return $this->pdo->lastInsertId();
    }
    public function consultar($sql)
    {   
        $sentencia = $this->pdo->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }
}

//$llamar= new conexion;
//$llamar->cerrar_conexion();

?>