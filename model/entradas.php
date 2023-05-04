<?php

class Entrada{
    public $idEntrada;
    public $fecha;
    public $fechaCaptura;
    public $idMovimiento;
    public $idUsuario;
    public $observaciones;
    private $conexion;

    function __construct(){
        $this->conexion = new conexion();
    }

    function InsertarEntrada(){
        try{
            $this->conexion->query = "INSERT INTO entrada (fecha, fechacaptura, idmovimiento, idusuario, observaciones) VALUES ('". $this->fecha ."','".$this->fechaCaptura ."',". $this->idMovimiento .",".$this->idUsuario .",'". $this->observaciones ."')";
            $this->idEntrada = $this->conexion->realizarInsert();
            return $this->idEntrada;
        }catch(Exception $x){
            echo $x;
        }
    }
}
?>