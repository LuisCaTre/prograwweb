<?php

class Producto{
    public $idProducto;
    public $nombre;
    public $descripcion;
    public $stockMinimo;
    public $stockMaximmo;
    private $conexion;

    function __construct(){
        $this->conexion = new conexion();
    }

    function InsertarProducto(){
        try{
            $this->conexion->query = "INSERT INTO producto (nombre, descripcion, stockminimo, stockmaximo) VALUES ('". $this->nombre ."','".$this->descripcion ."',". $this->stockMinimo .",". $this->stockMaximo .")";
            $this->idProducto = $this->conexion->realizarInsert();
            return $this->idProducto;
        }catch(Exception $x){
            echo $x;
        }
    }

    function ConsultarProductos(){
        try{
            $this->conexion->query = "SELECT * FROM producto";
            return $this->conexion->consultarDatos();
        }catch(Exception $x){
            echo $x;
        }
    }

    function ConsultarInventario(){
        try{
            $this->conexion->query = "SELECT Producto.idproducto, Producto.nombre, Producto.descripcion FROM producto Producto INNER JOIN (SELECT EntradaD.idproducto, EntradaD.existencia, EntradaD.iddetalle FROM entradadetalle EntradaD INNER JOIN (SELECT MAX(iddetalle) AS iddetalle FROM entradadetalle GROUP BY idproducto) Existencias ON Existencias.iddetalle = EntradaD.iddetalle) E ON E.idproducto = Producto.idproducto WHERE E.existencia > 0;";
            return $this->conexion->consultarDatos();
        }catch(Exception $x){
            echo $x;
        }
    }

    function ConsultarExistencias(){
        try{
            $this->conexion->query = "SELECT existencia FROM `entradadetalle` WHERE iddetalle = (SELECT MAX(iddetalle) FROM entradadetalle WHERE idproducto = ". $this->idProducto .");";
            return $this->conexion->consultarDatos();
        }catch(Exception $x){
            echo $x;
        }
    }
}
?>