<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

if (isset($_GET['id_egreso'])) {
    $id_egreso = $_GET['id_egreso'];
    $sql = "SELECT * FROM tb_egresos WHERE id_egreso = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_egreso]);
    $egreso = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$egreso) {
        $_SESSION['mensaje'] = "Egreso no encontrado";
        $_SESSION['icono'] = "error";
        header('Location: list_egresos.php');
        exit();
    }
} else {
    $_SESSION['mensaje'] = "ID de egreso no especificado";
    $_SESSION['icono'] = "error";
    header('Location: list_egresos.php');
    exit();
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Editar Egreso</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Editar los datos del egreso</h3>
                        </div>
                        <div class="card-body">
                            <form action="../app/controllers/egresos/update.php" method="post">
                                <input type="hidden" name="id_egreso" value="<?php echo htmlspecialchars($egreso['id_egreso']); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fecha_operacion">Fecha de Operación</label>
                                            <input type="date" name="fecha_operacion" id="fecha_operacion" class="form-control" value="<?php echo htmlspecialchars($egreso['fecha_operacion']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="responsable_operacion">Responsable de Operación</label>
                                            <input type="text" name="responsable_operacion" id="responsable_operacion" class="form-control" value="<?php echo htmlspecialchars($egreso['responsable_operacion']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="recibo_dinero">Recibo de Dinero</label>
                                            <input type="text" name="recibo_dinero" id="recibo_dinero" class="form-control" value="<?php echo htmlspecialchars($egreso['recibo_dinero']); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="monto">Monto</label>
                                            <input type="text" name="monto" id="monto" class="form-control" value="<?php echo number_format($egreso['monto'], 0, ',', '.'); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="concepto">Concepto</label>
                                            <input type="text" name="concepto" id="concepto" class="form-control" value="<?php echo htmlspecialchars($egreso['concepto']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea name="observaciones" id="observaciones" class="form-control"><?php echo htmlspecialchars($egreso['observaciones']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
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
