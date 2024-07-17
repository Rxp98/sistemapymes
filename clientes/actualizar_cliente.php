<?php
include('../app/config.php');
include('../layout/sesion.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];
    $sql = "SELECT * FROM tb_clientes WHERE id_cliente = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_cliente]);
    $cliente = $stmt->fetch();

    if (!$cliente) {
        // Redirigir si no se encuentra el cliente
        header('Location: list_customers.php');
        exit();
    }
} else {
    // Redirigir si no se recibe el id_cliente
    header('Location: list_customers.php');
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
                    <h1 class="m-0">Actualizar Clientes</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
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
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="../app/controllers/clientes/actualizar_cliente.php" method="post">
                                        <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($cliente['id_cliente']); ?>">
                                        <div class="form-group">
                                            <label for="nombre">Nombres</label>
                                            <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="documento">Documento</label>
                                            <input type="text" name="documento" class="form-control" value="<?php echo htmlspecialchars($cliente['documento']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" name="direccion" class="form-control" value="<?php echo htmlspecialchars($cliente['direccion']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" name="telefono" class="form-control" value="<?php echo htmlspecialchars($cliente['telefono']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="limite_credito">Límite de Crédito</label>
                                            <input type="text" name="limite_credito" class="form-control" value="<?php echo htmlspecialchars($cliente['limite_credito']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_pago">Fecha de Pago</label>
                                            <input type="date" name="fecha_pago" class="form-control" value="<?php echo htmlspecialchars($cliente['fecha_pago']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea name="observaciones" class="form-control" required><?php echo htmlspecialchars($cliente['observaciones']); ?></textarea>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="list_customers.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>
