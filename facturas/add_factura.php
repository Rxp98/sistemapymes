<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener la lista de proveedores
$sql = "SELECT id_proveedor, nombre_proveedor FROM tb_proveedores";
$stmt = $pdo->query($sql);
$proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registrar Factura Recibida</h1>
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
                            <h3 class="card-title">Llene los datos con cuidado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="formAddFactura" action="../app/controllers/facturas/add_facturas.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="id_proveedor">Proveedor</label>
                                            <select name="id_proveedor" id="id_proveedor" class="form-control" required>
                                                <?php foreach ($proveedores as $proveedor) { ?>
                                                    <option value="<?php echo $proveedor['id_proveedor']; ?>"><?php echo $proveedor['nombre_proveedor']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="numero_factura">Número de Factura</label>
                                            <input type="text" name="numero_factura" id="numero_factura" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_emision">Fecha de Emisión</label>
                                            <input type="date" name="fecha_emision" id="fecha_emision" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_recepcion">Fecha de Recepción</label>
                                            <input type="date" name="fecha_recepcion" id="fecha_recepcion" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="condicion">Condición</label>
                                            <select name="condicion" id="condicion" class="form-control" required>
                                                <option value="contado">Contado</option>
                                                <option value="crédito">Crédito</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="local_recepcion">Local de Recepción</label>
                                            <input type="text" name="local_recepcion" id="local_recepcion" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="monto_total">Monto Total de la Factura</label>
                                            <input type="text" name="monto_total" id="monto_total" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="compra_iva">Compra IVA %</label>
                                            <select name="compra_iva" id="compra_iva" class="form-control" required>
                                                <option value="10">10%</option>
                                                <option value="5">5%</option>
                                                <option value="exenta">Exenta</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="monto_descuento_nota_credito">Monto Descuento por Nota de Crédito</label>
                                            <input type="text" name="monto_descuento_nota_credito" id="monto_descuento_nota_credito" class="form-control" placeholder="Escriba aquí...">
                                        </div>
                                        <div class="form-group">
                                            <label for="monto_otro_descuento">Monto Otro Descuento</label>
                                            <input type="text" name="monto_otro_descuento" id="monto_otro_descuento" class="form-control" placeholder="Escriba aquí...">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="descripcion_otro_descuento">Descripción Otro Descuento</label>
                                            <input type="text" name="descripcion_otro_descuento" id="descripcion_otro_descuento" class="form-control" placeholder="Escriba aquí...">
                                        </div>
                                        <div class="form-group">
                                            <label for="monto_final">Monto Final a Pagar</label>
                                            <input type="text" name="monto_final" id="monto_final" class="form-control" placeholder="Escriba aquí..." required readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_pago">Fecha de Pago</label>
                                            <input type="date" name="fecha_pago" id="fecha_pago" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea name="observaciones" id="observaciones" class="form-control" placeholder="Escriba aquí..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group text-right">
                                    <a href="lista_facturas.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
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
    const montoTotalInput = document.getElementById('monto_total');
    const descuentoNotaCreditoInput = document.getElementById('monto_descuento_nota_credito');
    const otroDescuentoInput = document.getElementById('monto_otro_descuento');
    const montoFinalInput = document.getElementById('monto_final');
    const fechaEmisionInput = document.getElementById('fecha_emision');
    const fechaRecepcionInput = document.getElementById('fecha_recepcion');
    const fechaPagoInput = document.getElementById('fecha_pago');

    function calcularMontoFinal() {
        const montoTotal = parseFloat(montoTotalInput.value.replace(/\./g, '').replace(/,/g, '')) || 0;
        const descuentoNotaCredito = parseFloat(descuentoNotaCreditoInput.value.replace(/\./g, '').replace(/,/g, '')) || 0;
        const otroDescuento = parseFloat(otroDescuentoInput.value.replace(/\./g, '').replace(/,/g, '')) || 0;
        const montoFinal = montoTotal - descuentoNotaCredito - otroDescuento;
        montoFinalInput.value = montoFinal.toLocaleString('es-ES');
    }

    function validarFechas() {
        const fechaEmision = new Date(fechaEmisionInput.value);
        const fechaRecepcion = new Date(fechaRecepcionInput.value);
        const fechaPago = new Date(fechaPagoInput.value);

        if (fechaEmision > fechaRecepcion) {
            alert('La fecha de emisión no puede ser posterior a la fecha de recepción.');
            fechaEmisionInput.value = '';
        }

        if (fechaPago && fechaPago < fechaRecepcion) {
            alert('La fecha de pago no puede ser anterior a la fecha de recepción.');
            fechaPagoInput.value = '';
        }
    }

    function formatInput(input) {
        let value = input.value.replace(/\D/g, '');
        value = new Intl.NumberFormat('es-ES').format(value);
        input.value = value;
    }

    montoTotalInput.addEventListener('input', () => {
        formatInput(montoTotalInput);
        calcularMontoFinal();
    });

    descuentoNotaCreditoInput.addEventListener('input', () => {
        formatInput(descuentoNotaCreditoInput);
        calcularMontoFinal();
    });

    otroDescuentoInput.addEventListener('input', () => {
        formatInput(otroDescuentoInput);
        calcularMontoFinal();
    });

    fechaEmisionInput.addEventListener('change', validarFechas);
    fechaRecepcionInput.addEventListener('change', validarFechas);
    fechaPagoInput.addEventListener('change', validarFechas);

    document.getElementById('formAddFactura').addEventListener('submit', function (e) {
        montoTotalInput.value = montoTotalInput.value.replace(/\./g, '').replace(/,/g, '');
        descuentoNotaCreditoInput.value = descuentoNotaCreditoInput.value.replace(/\./g, '').replace(/,/g, '');
        otroDescuentoInput.value = otroDescuentoInput.value.replace(/\./g, '').replace(/,/g, '');
        montoFinalInput.value = montoFinalInput.value.replace(/\./g, '').replace(/,/g, '');
    });
});
</script>
