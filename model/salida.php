<?php

class Salida{
    public $idSalida;
    public $fecha;
    public $fechaCaptura;
    public $idMovimiento;
    public $idUsuarioRegistra;
    public $idUsuarioAsigna;
    public $observaciones;
    private $conexion;

    function __construct(){
        $this->conexion = new conexion();
    }

    function InsertarSalida(){
        try{
            $this->conexion->query = "INSERT INTO salida (fecha, fechacaptura, idmovimiento, idusuarioregistra, idusuarioasigna, observaciones) VALUES ('". $this->fecha ."','".$this->fechaCaptura ."',". $this->idMovimiento .",".$this->idUsuarioRegistra .",".$this->idUsuarioAsigna .",'". $this->observaciones ."')";
            $this->idSalida = $this->conexion->realizarInsert();
            return $this->idSalida;
        }catch(Exception $x){
            echo $x;
        }
    }
}
?>