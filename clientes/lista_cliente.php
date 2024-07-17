<?php
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');
include ('../app/controllers/clientes/listado_clientes.php');

?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Lista de Clientes</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Clientes Registrados</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="<?php echo $URL; ?>/clientes/crear_cliente.php" class="btn btn-primary">
                                        <i class="fas fa-user-plus"></i> Agregar Clientes
                                    </a>
                                </div>
                                <div class="table table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                            <th><center>Nro</center></th>
                                          <th><center>Nombres</center></th>
                                          <th><center>C.I.N</center></th>
                                          <th><center>Direccion</center></th>
                                          <th><center>Teléfono</center></th>
                                          <th><center>Límite de Crédito</center></th>
                                          <th><center>Fecha de Pago</center></th>
                                          <th><center>Observaciones</center></th>
                                          <th><center>Acciones</center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                      $contador = 0;
                                      foreach ($clientes_datos as $cliente_dato) {
                                          $id_cliente = $cliente_dato['id_cliente']; ?>
                                          <tr>
                                              <td><center><?php echo $contador = $contador + 1;?></center></td>
                                              <td><?php echo $cliente_dato['nombre'];?></td>
                                              <td><?php echo $cliente_dato['documento'];?></td>
                                              <td><?php echo $cliente_dato['direccion'];?></td>
                                              <td><?php echo $cliente_dato['telefono'];?></td>
                                              <td><?php echo $cliente_dato['limite_credito'];?></td>
                                              <td><?php echo $cliente_dato['fecha_pago'];?></td>
                                              
                                              <td><center><?php echo $cliente_dato['observaciones'];?></center></td>
                                              <td>
                                                  <center>
                                                      <div class="btn-group">
                                    
                                                          <a href="actualizar_cliente.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-success"><i class="fa fa-pencil-alt"></i> Editar</a>
                                                          <a href="borrar_cliente.php?id=<?php echo $id_cliente; ?>" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar</a>
                                                      </div>
                                                  </center>
                                              </td>
                                          </tr>
                                      <?php } ?>
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <th><center>Nro</center></th>
                                          <th><center>Nombres</center></th>
                                          <th><center>C.I.N</center></th>
                                          <th><center>Direccion</center></th>
                                          <th><center>Teléfono</center></th>
                                          <th><center>Límite de Crédito</center></th>
                                          <th><center>Fecha de Pago</center></th>
                                          <th><center>Observaciones</center></th>
                                          <th><center>Acciones</center></th>
                                      </tr>
                                  </tfoot>
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
  <!-- /.content-wrapper -->
  
  <?php include ('../layout/mensajes.php'); ?>
  <?php include ('../layout/parte2.php'); ?>

    <script>
        $(function () {
            $("#example1").DataTable({
                "pageLength": 5,
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                    "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Clientes",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscador:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
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
    
</body>



