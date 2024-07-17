<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener la lista de facturas pagadas
$sql = "SELECT fp.*, p.nombre_proveedor, b.nombre_banco 
        FROM tb_facturas_pagadas fp
        INNER JOIN tb_proveedores p ON fp.proveedor = p.id_proveedor
        LEFT JOIN tb_bancos b ON fp.banco = b.id_banco";
$stmt = $pdo->query($sql);
$facturas_pagadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Facturas Pagadas</h1>
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
                            <h3 class="card-title">Facturas Pagadas</h3>
                        </div>
                        <div class="card-body" style="display:block;">
                            <div class="table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Pago</th>
                                        <th>Proveedor</th>
                                        <th>Número de Factura</th>
                                        <th>Fecha de Emisión</th>
                                        <th>Fecha de Pago</th>
                                        <th>Monto</th>
                                        <th>Método de Pago</th>
                                        <th>Banco</th>
                                        <th>Número de Cheque/Transferencia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($facturas_pagadas as $pago): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($pago['id_pago']); ?></td>
                                        <td><?php echo htmlspecialchars($pago['nombre_proveedor']); ?></td>
                                        <td><?php echo htmlspecialchars($pago['numero_factura']); ?></td>
                                        <td><?php echo htmlspecialchars($pago['fecha_emision']); ?></td>
                                        <td><?php echo htmlspecialchars($pago['fecha_pago']); ?></td>
                                        <td><?php echo number_format($pago['monto'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($pago['metodo_pago']); ?></td>
                                        <td><?php echo htmlspecialchars($pago['nombre_banco']); ?></td>
                                        <td><?php echo htmlspecialchars($pago['numero_cheque_transferencia']); ?></td>
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
