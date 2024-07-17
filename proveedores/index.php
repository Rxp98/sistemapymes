<?php
session_start();
include('app/config.php');
include('layout/parte1.php');
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Gestión de Proveedores</h1>
                </div>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container-fluid">
            <?php include('layout/mensajes.php'); // Incluir mensajes de verificación ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listado de Proveedores</h3>
                            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalAgregarProveedor">Agregar Proveedor</button>
                        </div>
                        <div class="card-body">
                            <table id="tablaProveedores" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Contacto</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = $pdo->prepare("SELECT * FROM proveedores");
                                    $query->execute();
                                    $proveedores = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($proveedores as $proveedor) {
                                        echo "<tr>";
                                        echo "<td>{$proveedor['id']}</td>";
                                        echo "<td>{$proveedor['nombre']}</td>";
                                        echo "<td>{$proveedor['contacto']}</td>";
                                        echo "<td>{$proveedor['direccion']}</td>";
                                        echo "<td>{$proveedor['telefono']}</td>";
                                        echo "<td>{$proveedor['correo']}</td>";
                                        echo "<td>
                                            <button class='btn btn-warning btnEditar' data-id='{$proveedor['id']}' data-toggle='modal' data-target='#modalEditarProveedor'>Editar</button>
                                            <button class='btn btn-danger btnEliminar' data-id='{$proveedor['id']}' data-toggle='modal' data-target='#modalEliminarProveedor'>Eliminar</button>
                                        </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Proveedor -->
<div class="modal fade" id="modalAgregarProveedor" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarProveedorLabel">Agregar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAgregarProveedor" action="proveedores/agregar.php" method="POST">
                <div class="modal-body">
                    <!-- Formulario de Proveedor -->
                    <?php include('proveedores/form_proveedor.php'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Proveedor -->
<div class="modal fade" id="modalEditarProveedor" tabindex="-1" role="dialog" aria-labelledby="modalEditarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarProveedorLabel">Editar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditarProveedor" action="proveedores/editar.php" method="POST">
                <div class="modal-body">
                    <!-- Formulario de Proveedor -->
                    <?php include('proveedores/form_proveedor.php'); ?>
                    <input type="hidden" id="editarIdProveedor" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar Proveedor -->
<div class="modal fade" id="modalEliminarProveedor" tabindex="-1" role="dialog" aria-labelledby="modalEliminarProveedorLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarProveedorLabel">Eliminar Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEliminarProveedor" action="proveedores/eliminar.php" method="POST">
                <div class="modal-body">
                    <p>¿Está seguro de que desea eliminar este proveedor?</p>
                    <input type="hidden" name="id" id="eliminarIdProveedor">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('layout/parte2.php'); ?>

<script>
    $(document).ready(function() {
        $('#tablaProveedores').DataTable();

        // Llenar el formulario de edición con los datos del proveedor
        $('.btnEditar').on('click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: 'proveedores/obtener_proveedor.php',
                method: 'GET',
                data: {id: id},
                dataType: 'json',
                success: function(data) {
                    $('#formEditarProveedor #nombre').val(data.nombre);
                    $('#formEditarProveedor #contacto').val(data.contacto);
                    $('#formEditarProveedor #direccion').val(data.direccion);
                    $('#formEditarProveedor #telefono').val(data.telefono);
                    $('#formEditarProveedor #correo').val(data.correo);
                    $('#formEditarProveedor #editarIdProveedor').val(data.id); // Asignar ID al campo oculto
                }
            });
        });

        // Llenar el formulario de eliminación con el ID del proveedor
        $('.btnEliminar').on('click', function() {
            var id = $(this).data('id');
            $('#eliminarIdProveedor').val(id);
        });
    });
</script>
