<?php
    class Usuario {
        public $idusuario;
        public $usuario;
        public $contrasena;
        public $idperfil;
        public $activo;

        private $conexion;

        function __construct(){
            $this->conexion = new conexion();
        }

        function consultarUsuario(){
            try{
                $this->conexion->query = "SELECT U.idusuario, U.usuario, U.contrasena FROM usuario AS U WHERE U.usuario = '" . $this->usuario . "'
                    AND U.contrasena = '" . $this->contrasena . "' 
                    AND U.activo = 1";
                $datosUsuario = $this->conexion->consultarDatos();
                if ($datosUsuario->num_rows > 0){
                    $row = $datosUsuario->fetch_assoc();
                    $this->idusuario = $row["idusuario"];
                    $this->usuario = $row["usuario"];
                    $this->contrasena = $row["contrasena"];
                } else {
                    $this->idusuario = 0;
                    $this->usuario = "";
                    $this->contrasena = "";
                }
            } catch (Exception $x){
                throw $x;
            }
        }

        function validarUsuario(){
            try{
                $this->conexion->query = "SELECT idusuario, usuario, contrasena FROM usuario WHERE idusuario = '" . $this->idusuario . "'
                    AND contrasena = '" . $this->contrasena . "' 
                    AND activo = 1";
                $datos = $this->conexion->consultarDatos();
                if ($datos->num_rows > 0){
                    $row = $datos->fetch_assoc();
                    $this->idusuario = $row["idusuario"];
                    $this->usuario = $row["usuario"];
                    $this->contrasena = $row["contrasena"];
                } else {
                    $this->idusuario = 0;
                    $this->usuario = "";
                    $this->contrasena = "";
                }
            } catch (Exception $x){
                throw $x;
            }
        }

        function verUsuarios(){
            try{
                $this->conexion->query = "SELECT * FROM usuario WHERE activo = 1";
                return $this->conexion->consultarDatos();
            } catch (Exception $x){
                throw $x;
            }
        }
    }
?>