<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener la factura
$id_factura = $_GET['id'];
$sql = "SELECT * FROM tb_facturas_recibidas WHERE id_factura = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_factura]);
$factura = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$factura) {
    // Redirigir si no se encuentra la factura
    header('Location: list_facturas.php');
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
                    <h1 class="m-0">Eliminar Factura Recibida</h1>
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
                            <h3 class="card-title">¿Está seguro de que desea eliminar esta factura?</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="../app/controllers/facturas/delete_facturas.php" method="post">
                                <input type="hidden" name="id_factura" value="<?php echo $factura['id_factura']; ?>">
                                <div class="form-group">
                                    <label for="numero_factura">Número de Factura</label>
                                    <input type="text" name="numero_factura" id="numero_factura" class="form-control" value="<?php echo $factura['numero_factura']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_emision">Fecha de Emisión</label>
                                    <input type="date" name="fecha_emision" id="fecha_emision" class="form-control" value="<?php echo $factura['fecha_emision']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_recepcion">Fecha de Recepción</label>
                                    <input type="date" name="fecha_recepcion" id="fecha_recepcion" class="form-control" value="<?php echo $factura['fecha_recepcion']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="monto_final">Monto Final a Pagar</label>
                                    <input type="text" name="monto_final" id="monto_final" class="form-control" value="<?php echo $factura['monto_final']; ?>" disabled>
                                </div>
                                <hr>
                                <div class="form-group text-right">
                                    <a href="lista_facturas.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</button>
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
