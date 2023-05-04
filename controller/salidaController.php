<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/config/ConfigBD.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/conexion.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/salida.php");

class salidaController{
    function insertarSalida($fecha, $fechaCaptura, $idMovimiento, $idUsuarioRegistra, $idUsuarioAsigna, $observaciones){
        try{
            $salida = new salida();
            $salida->fecha = $fecha;
            $salida->fechaCaptura = $fechaCaptura;
            $salida->idMovimiento = $idMovimiento;
            $salida->idUsuarioRegistra = $idUsuarioRegistra;
            $salida->idUsuarioAsigna = $idUsuarioAsigna;
            $salida->observaciones = $observaciones;
            $idSalida = $salida->InsertarSalida();
            if($idSalida>0){
                echo '{"success":true,
                        "idSalida":'. $idSalida .'}';
            }else{
                echo '{"success":false}';
            }
        }catch(Exception $e){
            echo '{"success":false}';
        }
    }
}

if(isset($_POST["operacionSalida"])){
    switch ($_POST["operacionSalida"]){
        case "agregarSalida":
            $controller = new salidaController();
            $controller->insertarSalida($_POST["fechaSalida"], $_POST["fechaCaptura"], $_POST["tipoMovimiento"], $_POST["idUsuario"], $_POST["usuarioAsignado"],$_POST["observaciones"]);
            break;
        default:
            break;
    }
}
?>