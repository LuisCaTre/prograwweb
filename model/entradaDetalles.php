<?php

class EntradaDetalles{
    public $idDetalle;
    public $idEntrada;
    public $idProducto;
    public $cantidad;
    public $existencia;
    public $precio;
    public $observaciones;
    private $conexion;

    function __construct(){
        $this->conexion = new conexion();
    }

    function InsertarEntrada(){
        try{
            $this->conexion->query = "INSERT INTO entradadetalle (identrada, idproducto, cantidad, existencia, precio) VALUES (".$this->idEntrada .",". $this->idProducto .",".$this->cantidad .",". $this->existencia .",". $this->precio .")";
            $this->idDetalle = $this->conexion->realizarInsert();
            return $this->idDetalle;
        }catch(Exception $x){
            echo $x;
        }
    }

    function CostoPromedio(){
        try{
            $this->conexion->query = "SELECT AVG(precio) AS precioPromedio FROM entradadetalle WHERE idproducto = ". $this->idProducto ."";
            $this->costoPromedioProducto = $this->conexion->consultarDatos();
            return $this->costoPromedioProducto;
        }catch(Exception $x){
            echo $x;
        }
    }
}
?>