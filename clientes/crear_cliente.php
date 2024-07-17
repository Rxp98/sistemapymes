<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');


?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var input = document.getElementById('limite_credito');
        input.addEventListener('input', function (event) {
            var value = input.value.replace(/\D/g, '');
            input.value = new Intl.NumberFormat('es-ES').format(value);
        });
    });
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-8">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de Clientes</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="../app/controllers/clientes/store.php" method="post">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="documento">Documento de Identidad</label>
                                            <input type="text" name="documento" id="documento" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Escriba aquí..." required>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="limite_credito">Límite de Crédito</label>
                                        <input type="text" name="limite_credito" id="limite_credito" class="form-control" placeholder="Escriba aquí..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_pago">Fecha de Pago</label>
                                        <input type="date" name="fecha_pago" id="fecha_pago" class="form-control" placeholder="Escriba aquí..." required>
                                    </div>
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <input type="text" name="observaciones" id="observaciones" class="form-control" placeholder="Escriba aquí..." required>
                                    </div>
                                    <hr>
                                    <div class="form-group text-right">
                                        <a href="lista_cliente.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
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
