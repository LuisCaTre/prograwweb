<?php
class configBD
{
    function getConexion(){
        $archivo = 'configuracion.ini';
        if (!$ajustes = parse_ini_file($archivo, true)){
            throw new exception ('No se puede abrir el archivo' . $archivo);
        }

        $servidor = $ajustes["database_inventario"]["host"];
        $basedatos = $ajustes["database_inventario"]["basedatos"];
        $usuario = $ajustes["database_inventario"]["username"];
        $passwod = $ajustes["database_inventario"]["password"];

        try{
            $conexionMysqli = new mysqli($servidor, $usuario, $passwod, $basedatos);
            if ($conexionMysqli -> connect_errno){
                echo "Fallo la conexion con MySQL: (" . $conexionMysqli -> connect_errno . ") " . $conexionMysqli -> $connect_error;
            } else {
                return $conexionMysqli;
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
?>