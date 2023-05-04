<?php

class tipoMovimiento{
    public $idTipo;
    public $nombre;
    public $entradasalida;
    private $conexion;

    function __construct(){
        $this->conexion = new conexion();
    }

    function ConsultarMovimientos(){
        try{
            $this->conexion->query = "SELECT * FROM tiposmov";
            return $this->conexion->consultarDatos();
        }catch(Exception $x){
            echo $x;
        }
    }
}
?>