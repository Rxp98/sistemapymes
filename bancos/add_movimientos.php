<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener la lista de bancos
$sql = "SELECT id_banco, nombre_banco FROM tb_bancos";
$stmt = $pdo->query($sql);
$bancos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registrar Movimiento Bancario</h1>
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
                            <form id="formAddMovimiento" action="../app/controllers/bancos/store.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tipo_movimiento">Tipo de Movimiento</label>
                                            <select name="tipo_movimiento" id="tipo_movimiento" class="form-control" required>
                                                <option value="Depósito">Depósito</option>
                                                <option value="Retiro">Retiro</option>
                                                <option value="Transferencia">Transferencia</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="monto">Monto</label>
                                            <input type="text" name="monto" id="monto" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_movimiento">Fecha de Movimiento</label>
                                            <input type="date" name="fecha_movimiento" id="fecha_movimiento" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Escriba aquí..." required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="cuenta_bancaria">Cuenta Bancaria</label>
                                            <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="banco">Banco</label>
                                            <select name="banco" id="banco" class="form-control" required>
                                                <?php foreach ($bancos as $banco) { ?>
                                                    <option value="<?php echo $banco['nombre_banco']; ?>"><?php echo $banco['nombre_banco']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="referencia">Referencia</label>
                                            <input type="text" name="referencia" id="referencia" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <hr>
                                        <div class="form-group text-right">
                                            <a href="list_movimientos.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                                        </div>
                                    </div>
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
    const montoInput = document.getElementById('monto');

    function formatInput(input) {
        let value = input.value.replace(/\D/g, '');
        value = new Intl.NumberFormat('es-ES').format(value);
        input.value = value;
    }

    montoInput.addEventListener('input', () => {
        formatInput(montoInput);
    });

    document.getElementById('formAddMovimiento').addEventListener('submit', function (e) {
        montoInput.value = montoInput.value.replace(/\./g, '').replace(/,/g, '');
    });
});
</script>
