<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener información de los ingresos
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
                    <h1 class="m-0">Listado de Recibos</h1>
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
                            <h3 class="card-title">Recibos Guardados</h3>
                        </div>
                        <div class="d-flex justify-content-end mb-3 mt-3 mr-3">
                            
                                <a href="list_ingresos.php" class="btn btn-warning mr-2">
                                    <i class="fas fa-file-alt"></i> <--Volver--
                                </a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>N° de Recibo</th>
                                        <th>Fecha</th>
                                        <th>Monto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ingresos as $ingreso): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($ingreso['numero_comprobante']); ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($ingreso['fecha_ingreso'])); ?></td>
                                        <td><?php echo number_format($ingreso['monto_ingreso'], 0, ',', '.'); ?></td>
                                        <td>
                                            <a href="../recibos/recibo_<?php echo $ingreso['id_ingreso']; ?>.pdf" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i> Ver</a>
                                            <a href="/../recibos/recibo_<?php echo $ingreso['id_ingreso']; ?>.pdf" class="btn btn-success" download><i class="fa fa-download"></i> Descargar</a>
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
