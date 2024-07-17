<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener la lista de facturas
$sql = "SELECT f.*, p.nombre_proveedor FROM tb_facturas f INNER JOIN tb_proveedores p ON f.proveedor = p.id_proveedor";
$stmt = $pdo->query($sql);
$facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Facturas</h1>
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
                            <h3 class="card-title">Facturas Registradas</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Proveedor</th>
                                        <th>Número de Factura</th>
                                        <th>Fecha de Emisión</th>
                                        <th>Fecha de Recepción</th>
                                        <th>Monto Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($facturas as $factura): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($factura['id_factura']); ?></td>
                                        <td><?php echo htmlspecialchars($factura['nombre_proveedor']); ?></td>
                                        <td><?php echo htmlspecialchars($factura['numero_factura']); ?></td>
                                        <td><?php echo htmlspecialchars($factura['fecha_emision']); ?></td>
                                        <td><?php echo htmlspecialchars($factura['fecha_recepcion']); ?></td>
                                        <td><?php echo number_format($factura['monto_total'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($factura['estado']); ?></td>
                                        <td>
                                            <?php if ($factura['estado'] == 'Pendiente'): ?>
                                            <a href="pagar_factura.php?id_factura=<?php echo $factura['id_factura']; ?>" class="btn btn-success"><i class="fa fa-money-bill"></i> Pagar</a>
                                            <?php else: ?>
                                            <span class="badge badge-success">Pagado</span>
                                            <?php endif; ?>
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
