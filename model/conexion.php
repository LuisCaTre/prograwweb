<?php
class conexion{
    private $conectorBD;
    private $conexion;
    public $query;

    function __construct(){
        $this -> conectorBD = new ConfigBD();
        $this -> conexion = $this -> conectorBD -> getConexion();
    }

    function realizarInsert(){
        try{
            $Resultado = $this->conexion->query($this->query);
            if($Resultado){
                return $this->conexion->insert_id;
            } else {
                return 0;
            }
        } catch (Exception $x){
            throw $x;
        }
    }

    function consultarDatos(){
        try{
            $Resultado = $this->conexion->query($this->query);
            return $Resultado;
        } catch (Exception $x){
            throw $x;
        }
    }
}
?>