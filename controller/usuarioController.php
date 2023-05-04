<?php

include_once ($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/config/ConfigBD.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/conexion.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/model/usuarios.php");

class UsuarioController{
    function validarUsuario($idUsuario, $contrasena){
        $Usuario = new Usuario();
        $Usuario->idusuario = $idUsuario;
        $Usuario->contrasena = $contrasena;
        $Usuario->validarUsuario();

        if($Usuario->idusuario > 0){
            $obJson["resultado"] = 1;
            $obJson["mensaje"] = "Accediste al sistema";
        } else {
            $obJson["resultado"] = 2;
            $obJson["mensaje"] = "Atenticación incorrecta";
        }
        print json_encode($obJson);
    }
}

if(isset($_POST["operacionUsuario"])){
    switch ($_POST["operacionUsuario"]){
        case "validarUsuario":
            $Controller = new UsuarioController();
            $Controller->validarUsuario($_POST["usuarioAsignado"], $_POST["contrasenia"]);
            break;
        default;
            break;
    }
}
?>