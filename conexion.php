<?php
session_start();
class conexion{
    private $servidor="localhost";
    private $usuario="root";
    private $contrasenia="";
    private $conexion;
    public function __construct()
    {
        try {
            
        $this->conexion=new PDO("mysql:host=$this->servidor;dbname=productos",$this->usuario,$this->contrasenia);
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            return "falta de conexion ".$e;
        }
    }

    public function ejecutar($sql){
        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId();
    }
    
    public function NombresDeProductos($sql){
        $sentencia=$this->conexion->prepare($sql);
        $sentencia->execute();
        $resultados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $nombres = array();
        foreach($resultados as $fila){
            $nombres[] = strtoupper( $fila['Nombre']);
        }
        sort($nombres);
        return $nombres;
    }
    
    public function consultar($sql){
        $sentencia=$this->conexion->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }
}
?>