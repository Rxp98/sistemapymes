<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

$sql = "SELECT * FROM tb_movimientos_bancarios";
$stmt = $pdo->query($sql);
$movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Movimientos Bancarios</h1>
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
                            <h3 class="card-title">Movimientos Bancarios Registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mb-3 mt-3 mr-3">
                        <a href="<?php echo $URL; ?>/ingresos/list_ingresos.php" class="btn btn-warning mr-2">
                                <i class="fas fa-chart-line"></i> Ingresos...
                            </a>
                            <a href="<?php echo $URL; ?>/egresos/list_egreso.php" class="btn btn-primary mr-2">
                                <i class="fas fa-university"></i> Egresos...
                            </a>
                            <a href="<?php echo $URL; ?>/bancos/list_bancos.php" class="btn btn-primary mr-2">
                                <i class="fas fa-university"></i> Datos de Bancos
                            </a>
                            <a href="add_movimientos.php" class="btn btn-info mr-2">
                                <i class="fas fa-file-invoice-dollar"></i>.Movimientos
                            </a>
                            <a href="../facturas/lista_facturas.php" class="btn btn-success mr-2">
                                <i class="fas fa-coppy"></i> ..Facturas
                            </a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo de Movimiento</th>
                                        <th>Monto</th>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Cuenta Bancaria</th>
                                        <th>Banco</th>
                                        <th>Referencia</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($movimientos as $movimiento): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($movimiento['id_movimiento']); ?></td>
                                        <td><?php echo htmlspecialchars($movimiento['tipo_movimiento']); ?></td>
                                        <td><?php echo number_format($movimiento['monto'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($movimiento['fecha_movimiento']); ?></td>
                                        <td><?php echo htmlspecialchars($movimiento['descripcion']); ?></td>
                                        <td><?php echo htmlspecialchars($movimiento['cuenta_bancaria']); ?></td>
                                        <td><?php echo htmlspecialchars($movimiento['banco']); ?></td>
                                        <td><?php echo htmlspecialchars($movimiento['referencia']); ?></td>
                                        <td>
                                            <a href="edit_movimiento.php?id=<?php echo $movimiento['id_movimiento']; ?>" class="btn btn-success"><i class="fa fa-pencil-alt"></i>Editar</a>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteMovimiento" data-id="<?php echo $movimiento['id_movimiento']; ?>"><i class="fa fa-trash"></i>Eliminar</button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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

<!-- Modal Eliminar Movimiento -->
<div class="modal fade" id="modalDeleteMovimiento" tabindex="-1" role="dialog" aria-labelledby="modalDeleteMovimientoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteMovimientoLabel">Eliminar Movimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDeleteMovimiento" action="../app/controllers/bancos/delete_mov.php" method="post">
                    <input type="hidden" name="id_movimiento" id="delete_id_movimiento">
                    <p>¿Está seguro de que desea eliminar este movimiento?</p>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#modalDeleteMovimiento').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        var modal = $(this);
        modal.find('#delete_id_movimiento').val(id);
    });
</script>
