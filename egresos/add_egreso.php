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
                    <h1 class="m-0">Registrar Egreso</h1>
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
                        </div>
                        <div class="card-body">
                            <form action="../app/controllers/egresos/store.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_operacion">Fecha de Operación</label>
                                            <input type="date" name="fecha_operacion" id="fecha_operacion" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                                    <label for="">Responsable de la Operación:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" value="<?php echo $nombres_sesion; ?>" disabled>
                                                        <input type="text" name="responsable_operacion" value="<?php echo $nombres_sesion; ?>" hidden>
                                                    </div>
                                                </div>
                                        <div class="form-group">
                                            <label for="recibo_dinero">Recibo de Dinero</label>
                                            <input type="text" name="recibo_dinero" id="recibo_dinero" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label for="monto">Monto</label>
                                            <input type="text" name="monto" id="monto" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="concepto">Concepto</label>
                                            <input type="text" name="concepto" id="concepto" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea name="observaciones" id="observaciones" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <a href="list_egreso.php" class="btn btn-primary">cancelar</a>
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
    var input = document.getElementById('monto');
    input.addEventListener('input', function (event) {
        var value = input.value.replace(/\D/g, '');
        input.value = new Intl.NumberFormat('es-ES').format(value);
    });
});
</script>
