<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/config/configBD.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/conexion.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/usuarios.php");

    $nombreUsuario = $_POST['usuario'];
    $contraseniaUsuario = $_POST['contrasenia'];

    try{
        $objUsuario = new Usuario();
        $objUsuario->usuario = $nombreUsuario;
        $objUsuario->contrasena = $contraseniaUsuario;
        $objUsuario->consultarUsuario();

        if($objUsuario->idusuario > 0){
            session_start();
            if (!isset($_SESSION['idUsuario'])) {
                $_SESSION['idUsuario'] = $objUsuario->idusuario;
            }
            $obJson["resultado"] = 1;
            $obJson["mensaje"] = "Accediste al sistema";
        } else {
            $obJson["resultado"] = 2;
            $obJson["mensaje"] = "Atenticación incorrecta";
        }
        print json_encode($obJson);
    }
    catch(Exception $e){
        $obJson["resultado"] = "Error";
        $obJson["mensaje"] = "Error al procesar la solicitud";
        print json_encode($obJson);
    }
?>