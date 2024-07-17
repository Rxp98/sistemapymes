<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener la lista de facturas
$sql = "SELECT fr.id_factura, p.nombre_proveedor, fr.numero_factura, fr.fecha_emision, fr.fecha_recepcion, fr.condicion, fr.local_recepcion, fr.monto_total, fr.compra_iva, fr.monto_descuento_nota_credito, fr.monto_otro_descuento, fr.descripcion_otro_descuento, fr.monto_final, fr.fecha_pago, fr.observaciones
        FROM tb_facturas_recibidas fr
        INNER JOIN tb_proveedores p ON fr.id_proveedor = p.id_proveedor";
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
                    <h1 class="m-0">Listado de Facturas Recibidas</h1>
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
                            <h3 class="card-title">Facturas Registradas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mb-3 mt-3 mr-3">
                        <a href="../bancos/list_movimientos.php" class="btn btn-secondary mr-2"><i class="fas fa-sign-in-alt"></i>..Inicio</a>
                            <a href="add_factura.php" class="btn btn-info mr-2">
                                <i class="fas fa-plus-circle"></i> Agregar Factura
                            </a>
                                    </a>
                                <a href="pagar_factura.php" class="btn btn-warning mr-2">
                                    <i class="fas fa-file-invoice-dollar"></i> Pagar Factura
                                </a>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="table table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-ms">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Proveedor</th>
                                        <th><center>Nro Factura</center></th>
                                        <th>F. Emisión</th>
                                        <th>F. Recepción</th>
                                        <th>Condición</th>
                                        
                                        <th>Monto Total</th>
                                        
                                        <th>Des. Crédito</th>
                                        <th>Otro Des.</th>
                                        
                                        <th>Monto Final</th>
                                        <th>Fecha Pago</th>
                                        
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
                                        <td><?php echo htmlspecialchars($factura['condicion']); ?></td>
                                        
                                        <td><?php echo number_format($factura['monto_total'], 0, ',', '.'); ?></td>
                                        
                                       <td><?php echo number_format($factura['monto_descuento_nota_credito'], 0, ',', '.'); ?></td>
                                        <td><?php echo number_format($factura['monto_otro_descuento'], 0, ',', '.'); ?></td>
                                        
                                        <td><?php echo number_format($factura['monto_final'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($factura['fecha_pago']); ?></td>
                                        
                                        <td>
                                            <center>
                                            <div class="btn-group">
                                            <a href="editar_factura.php?id=<?php echo $factura['id_factura']; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i>Editar</a>
                                            <a href="eliminar_facturas.php?id=<?php echo $factura['id_factura']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Eliminar</a>

                                            </div>
                                            </center>
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

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Facturas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Facras",
                "infoFiltered": "(Filtrado de _MAX_ total Facturas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Facturas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy',
                }, {
                    extend: 'pdf'
                },{
                    extend: 'csv'
                },{
                    extend: 'excel'
                },{
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>