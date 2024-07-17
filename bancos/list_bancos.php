<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

$sql = "SELECT * FROM tb_bancos";
$stmt = $pdo->query($sql);
$bancos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Bancos</h1>
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
                            <h3 class="card-title">Bancos Registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="d-flex justify-content-end mb-3">
                                <a href="<?php echo $URL; ?>/bancos/list_movimientos.php" class="btn btn-primary">
                                        <i class="fas fa-row-left"></i> Volver
                                    </a>
                                    <br>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddBanco">Agregar Banco</button>
                                    </div>
                                </div>
                        <div class="card-body" style="display: block;">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre del Banco</th>
                                        <th>Número de Cuenta</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bancos as $banco): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($banco['id_banco']); ?></td>
                                        <td><?php echo htmlspecialchars($banco['nombre_banco']); ?></td>
                                        <td><?php echo htmlspecialchars($banco['numero_cuenta']); ?></td>
                                        <td><?php echo htmlspecialchars($banco['direccion']); ?></td>
                                        <td><?php echo htmlspecialchars($banco['telefono']); ?></td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modalEditBanco" data-id="<?php echo $banco['id_banco']; ?>" data-nombre="<?php echo $banco['nombre_banco']; ?>" data-cuenta="<?php echo $banco['numero_cuenta']; ?>">Editar</button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteBanco" data-id="<?php echo $banco['id_banco']; ?>">Eliminar</button>
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
</div>  

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>

<!-- Modal Agregar Banco -->
<div class="modal fade" id="modalAddBanco" tabindex="-1" role="dialog" aria-labelledby="modalAddBancoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddBancoLabel">Agregar Banco</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAddBanco" action="../app/controllers/bancos/add_bancos.php" method="post">
                    <div class="form-group">
                        <label for="nombre_banco">Nombre del Banco</label>
                        <input type="text" name="nombre_banco" id="nombre_banco" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="numero_cuenta">Número de Cuenta</label>
                        <input type="text" name="numero_cuenta" id="numero_cuenta" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" required>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Banco -->
<div class="modal fade" id="modalEditBanco" tabindex="-1" role="dialog" aria-labelledby="modalEditBancoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditBancoLabel">Editar Banco</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditBanco" action="../app/controllers/bancos/editar_bancos.php" method="post">
                    <input type="hidden" name="id_banco" id="edit_id_banco">
                    <div class="form-group">
                        <label for="edit_nombre_banco">Nombre del Banco</label>
                        <input type="text" name="nombre_banco" id="edit_nombre_banco" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_numero_cuenta">Número de Cuenta</label>
                        <input type="text" name="numero_cuenta" id="edit_numero_cuenta" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_direccion">Dirección</label>
                        <input type="text" name="direccion" id="edit_direccion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_telefono">Teléfono</label>
                        <input type="text" name="telefono" id="edit_telefono" class="form-control" required>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar Banco -->
<div class="modal fade" id="modalDeleteBanco" tabindex="-1" role="dialog" aria-labelledby="modalDeleteBancoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteBancoLabel">Eliminar Banco</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formDeleteBanco" action="../app/controllers/bancos/eliminar_bancos.php" method="post">
                    <input type="hidden" name="id_banco" id="delete_id_banco">
                    <p>¿Está seguro de que desea eliminar este banco?</p>
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
    $('#modalEditBanco').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nombre = button.data('nombre');
        var cuenta = button.data('cuenta');
        var direccion = button.data('direccion');
        var telefono = button.data('telefono');

        var modal = $(this);
        modal.find('#edit_id_banco').val(id);
        modal.find('#edit_nombre_banco').val(nombre);
        modal.find('#edit_numero_cuenta').val(cuenta);
        modal.find('#edit_direccion').val(direccion);
        modal.find('#edit_telefono').val(telefono);
    });

    $('#modalDeleteBanco').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        var modal = $(this);
        modal.find('#delete_id_banco').val(id);
    });
</script>
