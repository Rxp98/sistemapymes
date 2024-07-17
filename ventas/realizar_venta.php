<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/ventas/numero_venta.php');
include('../app/controllers/almacen/listado_de_productos.php');
//include('../app/controllers/ventas/cargar_carrio.php');
?>


    <link rel="stylesheet" href="../css_nuevo/ventas.css">

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">Nueva Venta</h1>
                </div>
               
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                        <h2>Módulo de Ventas</h2>
                        <form id="ventaForm" action="procesar_venta.php" method="post">
                         <div class="form-group">
                           <label for="producto"><i class="fas fa-box"></i> Producto</label>
                            <select id="producto" name="producto">
                            <?php
                            $result = $conn->query("SELECT id, nombre FROM productos");
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                            }
                            ?>
                        </select>
            </div>
            <div class="form-group">
                <label for="cantidad"><i class="fas fa-sort-numeric-up"></i> Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" required>
            </div>
            <div class="form-group">
                <label for="cliente"><i class="fas fa-user"></i> Cliente</label>
                <input type="text" id="cliente" name="cliente" required>
            </div>
            <div class="form-group">
                <label for="moneda"><i class="fas fa-dollar-sign"></i> Moneda</label>
                <select id="moneda" name="moneda">
                    <option value="PYG">Guaraní</option>
                    <option value="USD">Dólar</option>
                    <option value="ARS">Peso Argentino</option>
                    <option value="BRL">Real Brasileño</option>
                </select>
            </div>
            <div class="buttons">
                <button type="submit"><i class="fas fa-check"></i> Realizar Venta</button>
                <button type="reset" class="cancel"><i class="fas fa-times"></i> Cancelar</button>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se agregarán los productos vendidos -->
            </tbody>
        </table>
    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          
                            
    </div>
    </div>
</div>

</html>


<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>

<script>
    $(document).ready(function () {
        $("#modal-buscar_producto").on("shown.bs.modal", function () {
            $('#example1').DataTable();
        });
    });
</script>
