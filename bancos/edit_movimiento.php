<?php
include('../app/config.php');
include('../layout/sesion.php');

// Verificar si el ID de movimiento está en la URL
if (isset($_GET['id'])) {
    $id_movimiento = $_GET['id'];
    // Obtener el movimiento bancario
    $sql = "SELECT * FROM tb_movimientos_bancarios WHERE id_movimiento = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_movimiento]);
    $movimiento = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el movimiento existe
    if (!$movimiento) {
        $_SESSION['mensaje'] = "Movimiento no encontrado";
        $_SESSION['icono'] = "error";
        header('Location: list_movimientos.php');
        exit();
    }

    // Obtener la lista de bancos
    $sql = "SELECT id_banco, nombre_banco FROM tb_bancos";
    $stmt = $pdo->query($sql);
    $bancos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {
    $_SESSION['mensaje'] = "ID de movimiento no especificado";
    $_SESSION['icono'] = "error";
    header('Location: list_movimientos.php');
    exit();
}

include('../layout/parte1.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Editar Movimiento Bancario</h1>
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
                            <h3 class="card-title">Llene los datos con cuidado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="formEditMovimiento" action="../app/controllers/bancos/update.php" method="post">
                                <input type="hidden" name="id_movimiento" value="<?php echo $movimiento['id_movimiento']; ?>">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tipo_movimiento">Tipo de Movimiento</label>
                                            <select name="tipo_movimiento" id="tipo_movimiento" class="form-control" required>
                                                <option value="Depósito" <?php echo $movimiento['tipo_movimiento'] == 'Depósito' ? 'selected' : ''; ?>>Depósito</option>
                                                <option value="Retiro" <?php echo $movimiento['tipo_movimiento'] == 'Retiro' ? 'selected' : ''; ?>>Retiro</option>
                                                <option value="Transferencia" <?php echo $movimiento['tipo_movimiento'] == 'Transferencia' ? 'selected' : ''; ?>>Transferencia</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="monto">Monto</label>
                                            <input type="text" name="monto" id="monto" class="form-control" value="<?php echo number_format($movimiento['monto'], 0, ',', '.'); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_movimiento">Fecha de Movimiento</label>
                                            <input type="date" name="fecha_movimiento" id="fecha_movimiento" class="form-control" value="<?php echo $movimiento['fecha_movimiento']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea name="descripcion" id="descripcion" class="form-control" required><?php echo $movimiento['descripcion']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="cuenta_bancaria">Cuenta Bancaria</label>
                                            <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" class="form-control" value="<?php echo $movimiento['cuenta_bancaria']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="banco">Banco</label>
                                            <select name="banco" id="banco" class="form-control" required>
                                                <?php foreach ($bancos as $banco) { ?>
                                                    <option value="<?php echo $banco['nombre_banco']; ?>" <?php echo $movimiento['banco'] == $banco['nombre_banco'] ? 'selected' : ''; ?>><?php echo $banco['nombre_banco']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="referencia">Referencia</label>
                                            <input type="text" name="referencia" id="referencia" class="form-control" value="<?php echo $movimiento['referencia']; ?>" required>
                                        </div>
                                        <hr>
                                        <div class="form-group text-right">
                                            <a href="list_movimientos.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
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

    document.getElementById('formEditMovimiento').addEventListener('submit', function (e) {
        montoInput.value = montoInput.value.replace(/\./g, '').replace(/,/g, '');
    });
});
</script>
