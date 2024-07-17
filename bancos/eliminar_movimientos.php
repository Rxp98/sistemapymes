<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_movimiento'])) {
    $id_movimiento = $_GET['id_movimiento'];
    $sql = "SELECT * FROM tb_movimientos_bancarios WHERE id_movimiento = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_movimiento]);
    $movimiento = $stmt->fetch();

    if (!$movimiento) {
        header('Location: list_movimientos.php');
        exit();
    }
} else {
    header('Location: list_movimientos.php');
    exit();
}

include('../layout/parte2.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Eliminar Movimiento Bancario</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Confirmar Eliminación</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="../app/controllers/bancos/delete_mov.php" method="post">
                                <input type="hidden" name="id_movimiento" value="<?php echo htmlspecialchars($movimiento['id_movimiento']); ?>">
                                <div class="form-group">
                                    <label for="tipo_movimiento">Tipo de Movimiento</label>
                                    <input type="text" id="tipo_movimiento" class="form-control" value="<?php echo htmlspecialchars($movimiento['tipo_movimiento']); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="monto">Monto</label>
                                    <input type="text" id="monto" class="form-control" value="<?php echo htmlspecialchars($movimiento['monto']); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_movimiento">Fecha de Movimiento</label>
                                    <input type="date" id="fecha_movimiento" class="form-control" value="<?php echo htmlspecialchars($movimiento['fecha_movimiento']); ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea id="descripcion" class="form-control" disabled><?php echo htmlspecialchars($movimiento['descripcion']); ?></textarea>
                                </div>
                                <div class="form-group text-right">
                                    <a href="list_movimientos.php" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
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
