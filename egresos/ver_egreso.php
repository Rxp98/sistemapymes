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
                    <h1 class="m-0">Detalle del Egreso</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Egreso ID: <?php echo htmlspecialchars($egreso['id_egreso']); ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Fecha de Operación:</strong> <?php echo htmlspecialchars($egreso['fecha_operacion']); ?></p>
                                    <p><strong>Responsable de Operación:</strong> <?php echo htmlspecialchars($egreso['responsable_operacion']); ?></p>
                                    <p><strong>Recibo de Dinero:</strong> <?php echo htmlspecialchars($egreso['recibo_dinero']); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Monto:</strong> <?php echo number_format($egreso['monto'], 0, ',', '.'); ?></p>
                                    <p><strong>Concepto:</strong> <?php echo htmlspecialchars($egreso['concepto']); ?></p>
                                    <p><strong>Observaciones:</strong> <?php echo htmlspecialchars($egreso['observaciones']); ?></p>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <a href="list_egresos.php" class="btn btn-secondary">Volver</a>
                            </div>
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
