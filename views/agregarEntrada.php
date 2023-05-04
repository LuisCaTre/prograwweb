<?php
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/controller/tiposMovimientoController.php");
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/controller/productoController.php");
session_start();
?>

<style>
    #detalles {
        visibility: hidden;
    }
</style>

<form id="formularioCapturarEntrada" name="formularioCapturarEntrada">
    <div class="container-fluid mt-5" style="width: 100%;">
        <div style="width: 60%; height: 100%; margin-left: auto; margin-right: auto;">
            <div class="card card-success">
                <div class="card-header">
                    <div class="card-tittle" style="text-align: center"> Registro de Entrada de Inventario </div>
                </div>
                <div class="card-body">
                    <div class="mt-2 ">
                        <label for="tipoMovimiento" class="text-dark"> Tipo de Movimiento </label>
                        <select class="form-control" name="tipoMovimiento" id="tipoMovimiento">
                            <?php 
                                $tiposMovimientoController = new tiposMovimientoController();
                                $tiposMovimiento = $tiposMovimientoController->ConsultarMovimientos();

                                while($valores = $tiposMovimiento->fetch_assoc()){
                                    if($valores['entradasalida'] == 'E'){
                                        echo "<option value='" . $valores['idtipo'] . "'>" . $valores['nombre'] . "</option>";
                                    }  
                                }
                            ?> 
                        </select>
                        <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION['idUsuario'] ?>">
                        <input type="hidden" id="fechaCaptura" name="fechaCaptura" value="<?php echo date("Y-m-d h:i:s") ?>">
                        <input type="hidden" id="operacionEntrada" name="operacionEntrada" value="agregarEntrada">
                    </div>
                    <div class="mt-2">
                        <label for="fechaEntrada" class="text-dark" > Fecha de Entrada </label>
                        <input type="date" class="form-control" name="fechaEntrada" id="fechaEntrada" maxlength="350" required>
                    </div>
                    <div class="mt-2">
                        <label for="stockMaximo" class="text-dark"> Observaciones </label>
                        <textarea class="form-control" name="observaciones" id="observaciones"> </textarea>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto mt-3">
                        <button type="submit" style="width: 100%;" class="btn btn btn-success" id="agregarProducto"> Capturar Productos </button>
                    </div>
</form>
                    <div class="d-grid gap-2 col-10 mx-auto mt-3" id="detalles">
                        <table class="table-responsive table-striped" id='tablaDetalles'>
                            <thead>
                                <tr>
                                    <th scope="col" class="p-2"> </th>
                                    <th scope="col" class="p-2"> Descripcion </th>
                                    <th scope="col" class="p-2"> </th>
                                    <th scope="col" class="p-2"> Cantidad </th>
                                    <th scope="col" class="p-2"> Costo </th>
                                    <th scope="col" class="p-2"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-2">  </td>
                                    <td class="p-2"> <input type="text" class="form-control" disabled id="descripcionProducto" name="descripcionProducto"> 
                                    <input type="hidden" id="idProducto" name="idProducto">
                                    <input type="hidden" id="operacionDetalleEntrada" name="operacionDetalleEntrada" value="agregarDetalleEntrada"> </td>
                                    <td class="p-2"> <button type="button" style="width: 100%;" class="btn btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProductos" id="buscarProducto"> <i class="bi bi-search"></i> </button> </td>
                                    <td class="p-2"> <input type="number" class="form-control" id="cantidadProducto" name="cantidadProducto" value="0"> </td>
                                    <td class="p-2"> <input type="number" class="form-control" id="costoProducto" name="costoProducto" value="0"> </td>
                                    <td class="p-2"> <button type="button" style="width: 100%;" " class="btn btn btn-success" onclick="realizarCapturaDetalleEntrada()" id="agregarDetalle"> <i class="bi bi-cart-plus"></i> </button> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="modalProductos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="text-align: center">Seleccionar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-striped col-md-12 col-auto">
                <thead>
                    <tr>
                        <th scope="col" class="p-2" > Producto </th>
                        <th scope="col" class="p-2" > Descripcion </th>
                        <th scope="col" class="p-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        $productoController = new productoController();
                        $productos = $productoController->consultarProductos();

                        while ($row = $productos->fetch_assoc()){
                    ?>
                            <tr>
                                <td><?php echo utf8_encode($row["nombre"]) ?></td>
                                <td><?php echo utf8_encode($row["descripcion"]) ?></td>
                                <td class="text-center">
                                    <button class="btn btn-dark"  data-bs-dismiss="modal" onclick="mandarProducto(<?php echo utf8_encode($row["idproducto"]) ?>, '<?php echo utf8_encode($row["nombre"]) ?>')"> <i class="bi bi-plus-circle"></i> </button>
                                </td>
                            </tr>
                    <?php       
                        }
                    ?>
                    </tr>
                    <script type="text/javascript">
                        function realizarCapturaDetalleEntrada(){
                            idProducto = document.getElementById('idProducto').value;
                            descripcionProducto = document.getElementById('descripcionProducto').value;
                            cantidadProducto = document.getElementById('cantidadProducto').value;
                            costoProducto = document.getElementById('costoProducto').value;
                            operacionDetalleEntrada = document.getElementById('operacionDetalleEntrada').value;
                            exitenciasProducto = 0;

                            $.post("../controller/entradaDetalleController.php", {idProducto: idProducto, cantidadProducto: cantidadProducto, costoProducto: costoProducto, exitenciasProducto: exitenciasProducto, idEntrada: idEntrada, operacionDetalleEntrada: operacionDetalleEntrada}, function(recibido){
                                if(recibido.success){
                                    html = '<tr> <td class="p-2">  </td> <td class="p-2"> ' + descripcionProducto + ' </td> <td class="p-2"> </td> <td class="p-2"> ' + cantidadProducto + ' </td> <td class="p-2"> ' + costoProducto + ' </td> <td class="p-2"> </td> </tr>'
                                    $("#tablaDetalles").append(html);
                                    document.getElementById('descripcionProducto').value = "";
                                    document.getElementById('cantidadProducto').value = 0;
                                    document.getElementById('costoProducto').value = 0;
                                } else {
                                    alert("Error al realizar la operacion")
                                }
                            }, 'json');
                        }
                    </script>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Importar Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Validator -->
<script src="../dist/js/validator.js"></script>

<script type="text/javascript">
    var idEntrada;

    function realizarCapturaEntrada(){
        var datos = $("#formularioCapturarEntrada").serialize();
        $.post("../controller/entradaController.php", datos, function(recibido){
            if(recibido.success){
                document.getElementById('agregarProducto').style.display = "none";
                document.getElementById('detalles').style.visibility = "visible";
                idEntrada = recibido.idEntrada;
            } else {
                alert("Error al realizar la operacion")
            }
        }, 'json');
    }

    function validarFormularioEntrada(){
        $("#formularioCapturarEntrada").validator().on('submit', function(e){
            if(!e.isDefaultPrevented()){
                e.preventDefault();
                realizarCapturaEntrada();
            }
        });
    }

    $(document).ready(function(){
        validarFormularioEntrada();
    });

    function mandarProducto(idProducto, producto){
        document.getElementById('descripcionProducto').value = producto;
        document.getElementById('idProducto').value = idProducto;
    }
</script>