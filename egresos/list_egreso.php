<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener la lista de egresos
$sql = "SELECT * FROM tb_egresos";
$stmt = $pdo->query($sql);
$egresos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Egresos</h1>
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
                            <h3 class="card-title">Ingresos Registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mb-3 mt-3 mr-3">
                        <a href="../bancos/list_movimientos.php" class="btn btn-secondary mr-2"><i class="fas fa-sign-in-alt"></i>..Inicio</a>
                            <a href="add_egreso.php" class="btn btn-info mr-2">
                                <i class="fas fa-plus-circle"></i> Registrar Egreso
                            </a>
                                    </a>
                                <a href="../facturas_recibidas/pagar_factura.php" class="btn btn-warning mr-2">
                                    <i class="fas fa-file-invoice-dollar"></i> Pagar Factura
                                </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha de Operación</th>
                                        <th>Responsable</th>
                                        <th>Recibo</th>
                                        <th>Monto</th>
                                        <th>Concepto</th>
                                        <th>Observaciones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($egresos as $egreso): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($egreso['id_egreso']); ?></td>
                                        <td><?php echo htmlspecialchars($egreso['fecha_operacion']); ?></td>
                                        <td><?php echo htmlspecialchars($egreso['responsable_operacion']); ?></td>
                                        <td><?php echo htmlspecialchars($egreso['recibo_dinero']); ?></td>
                                        <td><?php echo number_format($egreso['monto'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($egreso['concepto']); ?></td>
                                        <td><?php echo htmlspecialchars($egreso['observaciones']); ?></td>
                                        <td>
                                            <a href="ver_egreso.php?id_egreso=<?php echo $egreso['id_egreso']; ?>" class="btn btn-primary"><i class="fa fa-eye"></i> Ver</a>
                                            <a href="editar_egreso.php?id_egreso=<?php echo $egreso['id_egreso']; ?>" class="btn btn-success"><i class="fa fa-pencil-alt"></i> Editar</a>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteEgreso" data-id="<?php echo $egreso['id_egreso']; ?>"><i class="fa fa-trash"></i> Eliminar</button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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

<!-- Modal Eliminar Egreso -->
<div class="modal fade" id="modalDeleteEgreso" tabindex="-1" role="dialog" aria-labelledby="modalDeleteEgresoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteEgresoLabel">Eliminar Egreso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDeleteEgreso" action="../app/controllers/egresos/eliminar.php" method="post">
                    <input type="hidden" name="id_egreso" id="delete_id_egreso">
                    <p>¿Está seguro de que desea eliminar este egreso?</p>
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
    $('#modalDeleteEgreso').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        var modal = $(this);
        modal.find('#delete_id_egreso').val(id);
    });
</script>
