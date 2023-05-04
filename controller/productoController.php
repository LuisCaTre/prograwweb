<?php

include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/config/configBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/producto.php");

class productoController{
    function insertarProducto($nombre, $descripcion, $stockMinimo, $stockMaximo){
        try{
            $producto = new producto();
            $producto->nombre = $nombre;
            $producto->descripcion = $descripcion;
            $producto->stockMinimo = $stockMinimo;
            $producto->stockMaximo = $stockMaximo;
            if($producto->InsertarProducto()>0){
                echo '{"success":true}';
            }else{
                echo '{"success":false}';
            }
        }catch(Exception $e){
            echo '{"success":false}';
        }
    }

    function ConsultarProductos(){
        try{
            $producto = new producto();
            $dataProducto = $producto->ConsultarProductos();
            return $dataProducto;
        }catch(Exception $e){
            echo '{"success":false}';
        }
    }

    function ConsultarInventario(){
        try{
            $producto = new producto();
            $dataProducto = $producto->ConsultarInventario();
            return $dataProducto;
        }catch(Exception $e){
            echo '{"success":false}';
        }
    }
}

if(isset($_POST["operacion"])){
    switch ($_POST["operacion"]){
        case "agregarProducto":
            $controller = new productoController();
            $controller->insertarProducto($_POST["nombreProducto"], $_POST["descripcionProducto"], $_POST["stockMinimo"], $_POST["stockMaximo"]);
            break;
        default:
            break;
    }
}
?>