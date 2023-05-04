<?php
class SalidaDetalle{
    public $IdDetalle;
    public $idSalida;
    public $IdProducto;
    public $Cantidad;
    public $Precio;

    private $conexion;

    function __construct(){
        $this->conexion = new conexion();
    }

    function AgregarSalida(){
        try{
            $this->conexion->query = "INSERT INTO salidadetalle (idsalida, idproducto, cantidad, precio) VALUES (".$this->idSalida .",". $this->IdProducto .",".$this->Cantidad .",". $this->Precio .")";
            $this->idDetalle = $this->conexion->realizarInsert();
            return $this->idDetalle;
        }catch(Exception $x){
            echo $x;
        }
    }
}
?>