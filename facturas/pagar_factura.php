<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener lista de bancos
$sql_bancos = "SELECT * FROM tb_bancos";
$stmt_bancos = $pdo->query($sql_bancos);
$bancos = $stmt_bancos->fetchAll(PDO::FETCH_ASSOC);

// Obtener lista de proveedores
$sql_proveedores = "SELECT * FROM tb_proveedores";
$stmt_proveedores = $pdo->query($sql_proveedores);
$proveedores = $stmt_proveedores->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Pagar Factura</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Seleccione el Método de Pago</h3>
                        </div>
                        <div class="card-body">
                            <form action="../app/controllers/egresos/pagar_factura.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="proveedor">Proveedor</label>
                                            <select name="proveedor" id="proveedor" class="form-control" required>
                                                <?php foreach ($proveedores as $proveedor) { ?>
                                                    <option value="<?php echo $proveedor['id_proveedor']; ?>"><?php echo $proveedor['nombre_proveedor']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="metodo_pago">Método de Pago</label>
                                            <select name="metodo_pago" id="metodo_pago" class="form-control" required>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="Cheque al día">Cheque al día</option>
                                                <option value="Cheque diferido">Cheque diferido</option>
                                                <option value="Transferencia">Transferencia</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="banco">Banco</label>
                                            <select name="banco" id="banco" class="form-control">
                                                <?php foreach ($bancos as $banco) { ?>
                                                    <option value="<?php echo $banco['id_banco']; ?>"><?php echo $banco['nombre_banco']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="numero_cheque_transferencia">Número de Cheque/Transferencia</label>
                                            <input type="text" name="numero_cheque_transferencia" id="numero_cheque_transferencia" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_emision">Fecha de Emisión</label>
                                            <input type="date" name="fecha_emision" id="fecha_emision" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_pago">Fecha de Pago</label>
                                            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="monto">Monto</label>
                                            <input type="text" name="monto" id="monto" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-info">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var metodoPago = document.getElementById('metodo_pago');
    var numeroChequeTransferencia = document.getElementById('numero_cheque_transferencia');

    metodoPago.addEventListener('change', function () {
        if (metodoPago.value === 'Efectivo') {
            numeroChequeTransferencia.disabled = true;
            numeroChequeTransferencia.value = '';
        } else {
            numeroChequeTransferencia.disabled = false;
        }
    });

    var montoInput = document.getElementById('monto');
    montoInput.addEventListener('input', function (event) {
        var value = montoInput.value.replace(/\D/g, '');
        montoInput.value = new Intl.NumberFormat('es-ES').format(value);
    });
});
</script>
