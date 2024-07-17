<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

$sql = "SELECT * FROM tb_ingresos";
$stmt = $pdo->query($sql);
$ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Ingresos</h1>
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
                            <h3 class="card-title">Ingresos Registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mb-3 mt-3 mr-3">
                            <a href="add_ingresos.php" class="btn btn-info mr-2">
                                <i class="fas fa-plus-circle"></i> Registrar Ingreso
                            </a>
                                    </a>
                                <a href="list_recibos.php" class="btn btn-warning mr-2">
                                    <i class="fas fa-file-alt"></i> Recibos..
                                </a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Responsable Entrega</th>
                                        <th>Responsable Recibir</th>
                                        <th>Monto</th>
                                        <th>Comprobante N°</th>
                                        <th>Observaciones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ingresos as $ingreso): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($ingreso['id_ingreso']); ?></td>
                                        <td><?php echo htmlspecialchars($ingreso['fecha_ingreso']); ?></td>
                                        <td><?php echo htmlspecialchars($ingreso['responsable_entrega']); ?></td>
                                        <td><?php echo htmlspecialchars($ingreso['responsable_recibir']); ?></td>
                                        <td><?php echo number_format($ingreso['monto_ingreso'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($ingreso['numero_comprobante']); ?></td>
                                        <td><?php echo htmlspecialchars($ingreso['observaciones']); ?></td>
                                        <td>
                                            <a href="edit_ingresos.php?id=<?php echo $ingreso['id_ingreso']; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i>Editar</a>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDeleteIngreso" data-id="<?php echo $ingreso['id_ingreso']; ?>"><i class="fa fa-trash"></i>Eliminar</button>
                                            <a href="print_recibos.php?id=<?php echo $ingreso['id_ingreso']; ?>" class="btn btn-info btn-sm"><i class="fa fa-print"></i>Imprimir</a>
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

<!-- Modal Eliminar Ingreso -->
<div class="modal fade" id="modalDeleteIngreso" tabindex="-1" role="dialog" aria-labelledby="modalDeleteIngresoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteIngresoLabel">Eliminar Ingreso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDeleteIngreso" action="../app/controllers/ingreso/delete_ingreso.php" method="post">
                    <input type="hidden" name="id_ingreso" id="delete_id_ingreso">
                    <p>¿Está seguro de que desea eliminar este ingreso?</p>
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
    $('#modalDeleteIngreso').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        var modal = $(this);
        modal.find('#delete_id_ingreso').val(id);
    });
</script>
