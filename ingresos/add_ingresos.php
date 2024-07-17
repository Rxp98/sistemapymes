<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registrar Ingreso</h1>
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
                            <form id="formAddIngreso" action="../app/controllers/ingreso/store.php" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                                            <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                                    <label for="">Usuario Responsable:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" value="<?php echo $nombres_sesion; ?>" disabled>
                                                        <input type="text" name="responsable_entrega" value="<?php echo $nombres_sesion; ?>" hidden>
                                                    </div>
                                                </div>
                                        <div class="form-group">
                                            <label for="responsable_recibir">Responsable de Recibir</label>
                                            <input type="text" name="responsable_recibir" id="responsable_recibir" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="monto_ingreso">Monto de Ingreso</label>
                                            <input type="text" name="monto_ingreso" id="monto_ingreso" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="numero_comprobante">Número de Comprobante</label>
                                            <input type="text" name="numero_comprobante" id="numero_comprobante" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea name="observaciones" id="observaciones" class="form-control" placeholder="Escriba aquí..." required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <hr>
                                        <div class="form-group text-right">
                                            <a href="list_ingresos.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
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
    const montoIngresoInput = document.getElementById('monto_ingreso');

    function formatInput(input) {
        let value = input.value.replace(/\D/g, '');
        value = new Intl.NumberFormat('es-ES').format(value);
        input.value = value;
    }

    montoIngresoInput.addEventListener('input', () => {
        formatInput(montoIngresoInput);
    });

    document.getElementById('formAddIngreso').addEventListener('submit', function (e) {
        montoIngresoInput.value = montoIngresoInput.value.replace(/\./g, '').replace(/,/g, '');
    });
});
</script>
