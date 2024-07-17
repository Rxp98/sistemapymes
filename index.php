<?php
include ('app/config.php');
include ('layout/sesion.php');



include ('layout/parte1.php');
include ('app/controllers/usuarios/listado_de_usuarios.php');
include ('app/controllers/roles/listado_de_roles.php');
include ('app/controllers/categorias/listado_de_categoria.php');
include ('app/controllers/almacen/listado_de_productos.php');
include ('app/controllers/proveedores/listado_de_proveedores.php');
include ('app/controllers/clientes/listado_clientes.php');
include ('app/controllers/clientes/carga_cliente.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                <center>
                     <h1 class="m-0"> - <?php echo $rol_sesion; ?> </h1>
                </center>
                   
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            Contenidos del Sistema
            

            <div class="row">


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            $contador_de_usuarios = 0;
                            foreach ($usuarios_datos as $usuarios_dato){
                                $contador_de_usuarios = $contador_de_usuarios + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_usuarios;?></h3>
                            <p>Usuarios Registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/usuarios/create.php">
                            <div class="icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/usuarios" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $contador_de_roles = 0;
                            foreach ($roles_datos as $roles_dato){
                                $contador_de_roles = $contador_de_roles + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_roles;?></h3>
                            <p>Roles Registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/roles/create.php">
                            <div class="icon">
                                <i class="fas fa-address-card"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/roles" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            $contador_de_categorias = 0;
                            foreach ($categorias_datos as $categorias_dato){
                                $contador_de_categorias = $contador_de_categorias + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_categorias;?></h3>
                            <p>Categorías Registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/categorias">
                            <div class="icon">
                                <i class="fas fa-tags"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/categorias" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <?php
                            $contador_de_productos = 0;
                            foreach ($productos_datos as $productos_dato){
                                $contador_de_productos = $contador_de_productos + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_productos;?></h3>
                            <p>Productos Registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/almacen/create.php">
                            <div class="icon">
                                <i class="fas fa-list"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/almacen" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>





                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $contador_de_proveedores = 0;
                            foreach ($proveedores_datos as $proveedores_dato){
                                $contador_de_proveedores = $contador_de_proveedores + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_proveedores;?></h3>
                            <p>Proveedores Registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/proveedores">
                            <div class="icon">
                                <i class="fas fa-truck"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/proveedores" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <?php
                            $contador_de_clientes = 0;
                            foreach ($clientes_datos as $clientes_dato){
                                $contador_de_clientes = $contador_de_clientes + 1;
                            }
                             ?>
                            <h3><?php echo $contador_de_clientes;?></h3>
                            <p>Clientes Registrados</p>
                        </div>
                        <a href="<?php echo $URL;?>/clientes/lista_cliente.php">
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL;?>/clientes/lista_cliente.php" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


            </div>
            <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Ventas</h3>
                  <a href="javascript:void(0);">Ver Reportes</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">$18,230.00</span>
                    <span>Ventas hasta la fecha</span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Desde el mes pasado</span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> Este Año
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Último Año
                  </span>
                </div>
              </div>
            </div>
            <!-- /.card -->


            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
</div>
<?php include ('layout/parte2.php'); ?>
