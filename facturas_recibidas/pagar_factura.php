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

// Verificar si se ha pasado un ID de factura
$id_factura = isset($_GET['id_factura']) ? $_GET['id_factura'] : null;
$factura = null;
if ($id_factura) {
    // Obtener detalles de la factura
    $sql_factura = "SELECT * FROM tb_facturas_recibidas WHERE id_factura = ?";
    $stmt_factura = $pdo->prepare($sql_factura);
    $stmt_factura->execute([$id_factura]);
    $factura = $stmt_factura->fetch(PDO::FETCH_ASSOC);
}
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
                                <input type="hidden" name="id_factura" value="<?php echo $id_factura; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="proveedor">Proveedor</label>
                                            <select name="proveedor" id="proveedor" class="form-control" required>
                                                <?php foreach ($proveedores as $proveedor) { ?>
                                                    <option value="<?php echo $proveedor['id_proveedor']; ?>" <?php echo ($factura && $factura['proveedor'] == $proveedor['id_proveedor']) ? 'selected' : ''; ?>><?php echo $proveedor['nombre_proveedor']; ?></option>
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
                                            <select name="banco" id="banco" class="form-control" disabled>
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
                                            <input type="date" name="fecha_emision" id="fecha_emision" class="form-control" value="<?php echo $factura ? $factura['fecha_emision'] : ''; ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_pago">Fecha de Pago</label>
                                            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="monto">Monto</label>
                                            <input type="text" name="monto" id="monto" class="form-control" value="<?php echo $factura ? number_format($factura['monto_final'], 0, ',', '.') : ''; ?>" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <a href="lista_facturas.php" class="btn btn-secondary">Cancelar</a>
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
    var bancoSelect = document.getElementById('banco');
    var numeroChequeTransferencia = document.getElementById('numero_cheque_transferencia');

    metodoPago.addEventListener('change', function () {
        if (metodoPago.value === 'Efectivo') {
            numeroChequeTransferencia.disabled = true;
            bancoSelect.disabled = true;
            numeroChequeTransferencia.value = '';
            bancoSelect.value = '';
        } else {
            numeroChequeTransferencia.disabled = false;
            bancoSelect.disabled = false;
        }
    });

    var montoInput = document.getElementById('monto');
    montoInput.addEventListener('input', function (event) {
        var value = montoInput.value.replace(/\D/g, '');
        montoInput.value = new Intl.NumberFormat('es-ES').format(value);
    });
});
</script>
