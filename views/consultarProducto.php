<?php
include_once($_SERVER['DOCUMENT_ROOT']."/SistemaInventario_Parte2/controller/productoController.php");
?>

<h3 class="text-center text-black" > Tabla Consulta de Productos </h3>
<hr width="5px">
<div class="table-responsive">
    <table id="tablaProductos" class="display table-light table-bordered" width='100%'>
        <thead>
            <tr>
                <th style="text-align: center"> Nombre del producto </th>
                <th style="text-align: center"> Descripcion </th>
                <th style="text-align: center"> Stock Minimo </th>
                <th style="text-align: center"> Stock Maximo </th>
                <th style="text-align: center"> Operaciones </th>
            </tr>
        </thead>

        <tbody>
            <?php
                $productoController = new productoController();
                $productos = $productoController->consultarProductos();

                while ($row = $productos->fetch_assoc()){
            ?>
                    <tr>
                        <td><?php echo utf8_encode($row["nombre"]) ?></td>
                        <td><?php echo utf8_encode($row["descripcion"]) ?></td>
                        <td><?php echo utf8_encode($row["stockminimo"]) ?></td>
                        <td><?php echo utf8_encode($row["stockmaximo"]) ?></td>
                        <td class="text-center">
                            <button class="btn btn-danger" onclick="" style=""> Seleccionar </button> <br>
                            <a class="btn btn-primary" href="#" style=""> Consultar </a> <br><br>
                        </td>
                    </tr>
            <?php       
                }
            ?>
        </tbody>
    </table>
</div>
