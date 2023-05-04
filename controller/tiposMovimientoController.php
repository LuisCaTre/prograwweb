<?php

include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/config/configBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/tiposMovimiento.php");

class tiposMovimientoController{
    function ConsultarMovimientos(){
        try{
            $movimientos = new tipoMovimiento();
            $dataMovimiento = $movimientos->ConsultarMovimientos();
            return $dataMovimiento;
        }catch(Exception $e){
            echo '{"success":false}';
        }
    }
}
?>