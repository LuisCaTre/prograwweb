<?php

include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/config/configBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/entradas.php");

class entradaController{
    function insertarEntrada($fecha, $fechaCaptura, $idMovimiento, $idUsuario, $observaciones){
        try{
            $entrada = new entrada();
            $entrada->fecha = $fecha;
            $entrada->fechaCaptura = $fechaCaptura;
            $entrada->idMovimiento = $idMovimiento;
            $entrada->idUsuario = $idUsuario;
            $entrada->observaciones = $observaciones;
            $idEntrada = $entrada->InsertarEntrada();
            if($idEntrada>0){
                echo '{"success":true,
                        "idEntrada":'. $idEntrada .'}';
            }else{
                echo '{"success":false}';
            }
        }catch(Exception $e){
            echo '{"success":false}';
        }
    }
}

if(isset($_POST["operacionEntrada"])){
    switch ($_POST["operacionEntrada"]){
        case "agregarEntrada":
            $controller = new entradaController();
            $controller->insertarEntrada($_POST["fechaEntrada"], $_POST["fechaCaptura"], $_POST["tipoMovimiento"], $_POST["idUsuario"], $_POST["observaciones"]);
            break;
        default:
            break;
    }
}
?>