<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuario</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
</head>
<body>
    <form id="formulario">
        <div class="container-fluid mt-5" style="width: 100%;">
            <div style="width: 40%; height: 20%; margin-left: auto; margin-right: auto;">
                <div class="card card-black">
                    <div class="card-header">
                        <div class="card-tittle" style="text-align: center"> Sistema de Registro de Inventarios </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <label for="nombre" class="text-dark" > Nombre de Usuario </label>
                            <input class="form-control" type="text" minlength="3" maxlength="20" onkeypress="return checarSoloLetras(event)" name="usuario" id="usuario" placeholder="Ingresa el Usuario" required>
                        </div>
                        <div>
                            <label for="añoNacimiento" class="text-dark"> Contraseña </label>
                            <input class="form-control" type="password" minlength="3" maxlength="20" onkeypress="return checarSinComillas(event)" name="contrasenia" id="contrasenia" placeholder="Ingresa la Contraseña" required>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto mt-3">
                            <button type="submit" style="width: 100%; background-color: black" class="btn btn btn-success" id="entrar"> Ingresar </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- Validator -->
    <script src="/dist/js/validator.js"></script>

    <script type="text/javascript">
        function  checarSoloLetras(evento) {
            tecla = evento.keyCode;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8) {
                return true;
            }

            // Patrón de entrada, en este caso solo acepta numeros y letras
            patron = /[A-Za-z]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }

        function  checarSinComillas(evento) {
            tecla = evento.keyCode;

            //Tecla de retroceso para borrar, siempre la permite
            if (tecla == 8) {
                return true;
            }

            // Patrón de entrada, en este caso solo acepta numeros y letras
            patron = /[^(")(')]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }

        function realizarPeticion(){
            var datos = $("#formulario").serialize();
            $.post("/controller/acceso.php", datos, function(recibido){
                if (recibido.resultado == 1){
                    window.location.href = "menu.html";
                } else {
                    alert(recibido.mensaje);
                }
            }, 'json');
        }

        function validarFormulario(){
            $("#formulario").validator().on('submit', function(e){
                if(!e.isDefaultPrevented()){
                    e.preventDefault();
                    realizarPeticion();
                }
            });
        }

        $(document).ready(function(){
            validarFormulario();
        });
    </script>
</body>
</html>
