<?php
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/config/configBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/salidaDetalles.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/producto.php");




class SalidaDetalleController{
    function AgregarSalida($idSalida, $IdProducto, $Cantidad, $Precio){
        try{
            $Salida = new SalidaDetalle();
            $Salida->idSalida = $idSalida;
            $Salida->IdProducto = $IdProducto;
            $Salida->Cantidad = $Cantidad;
            $Salida->Precio = $Precio;

            $existencias = new Producto();
            $existencias->idProducto = $IdProducto;
            $inventario = $existencias->ConsultarExistencias();
            $row = $inventario->fetch_assoc();

            if($Cantidad <= $row['existencia'] && $Cantidad > 0){
                if($Salida->AgregarSalida()>0){
                    echo '{"success":true}';
                }else{
                    echo '{"success":false}';
                }
            }else{
                echo '{"success":false}';
            }
        }catch(Exception $e){
            echo '{"success":false}';
        }
    }
}

if(isset($_POST["operacionDetalleSalida"])){
    switch ($_POST["operacionDetalleSalida"]){
        case "agregarDetalleSalida":
            $SalidaDetalleController = new SalidaDetalleController();
            $SalidaDetalleController->AgregarSalida($_POST["idSalida"], $_POST["idProducto"], $_POST["cantidadProducto"], $_POST["costoProducto"]);
            break;
        default:
            break;
    }
}
?>