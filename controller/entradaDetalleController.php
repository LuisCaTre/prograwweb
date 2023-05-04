<?php

include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/config/configBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/entradaDetalles.php");

class entradaDetalleController{
    function insertarEntrada($idEntrada, $idProducto, $cantidad, $existencia, $precio){
        try{
            $entradaDetalles = new EntradaDetalles();
            $entradaDetalles->idEntrada = $idEntrada;
            $entradaDetalles->idProducto = $idProducto;
            $entradaDetalles->cantidad = $cantidad;
            $entradaDetalles->existencia = $existencia;
            $entradaDetalles->precio = $precio;
            if($entradaDetalles->InsertarEntrada()>0){
                echo '{"success":true}';
            }else{
                echo '{"success":false}';
            }
        }catch(Exception $e){
            echo '{"success":false}';
        }
    }

    function CostoPromedio($IdProducto){
        try{
            $EntradaDetalle = new EntradaDetalles();
            $EntradaDetalle->idProducto = $IdProducto;
            $Costo = $EntradaDetalle->CostoPromedio();
            $row = $Costo->fetch_assoc();
            echo '{"success":true,
                "costoPromedio":'. $row['precioPromedio'] .'}';
        }catch(Exception $e){
            echo '{"success":false}';
        }
    }
}

if(isset($_POST["operacionDetalleEntrada"])){
    switch ($_POST["operacionDetalleEntrada"]){
        case "agregarDetalleEntrada":
            $controller = new entradaDetalleController();
            $controller->insertarEntrada($_POST["idEntrada"], $_POST["idProducto"], $_POST["cantidadProducto"], $_POST["exitenciasProducto"], $_POST["costoProducto"]);
            break;
        case "costoPromedio":
            $EntradaDetalleController = new entradaDetalleController();
            $EntradaDetalleController->CostoPromedio($_POST["idProducto"]);
            break;
        default:
            break;
    }
}
?>