
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de ventas</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme  style -->
    <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">
     <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/public/style/plugins/summernote/summernote-bs4.min.css">

  

    <!-- Libreria Sweetallert2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="../css_nuevo/index_user.css">
   </head>
<body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                
                <center>
                     <h2 class="m-0">Sistema "Bienvenido": <?php echo $rol_sesion; ?> </h2>
                </center>
                
                </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
    <a class="nav-link" href="<?php echo $URL;?>/app/controllers/login/cerrar_sesion.php">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a>
</li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo $URL;?>" class="brand-link">
            <img src="<?php echo $URL;?>/public/images/carrito.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">SuperMercado</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo $URL;?>/public/images/perfil.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo $nombres_sesion;?></a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 

                <li class="nav-item ">
                      <a href="#" class="nav-link">  
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                          Ventas
                          <i class="right fas fa-angle-right"></i>
                        </p>
                      </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item ">
                          <a href="<?php echo $URL;?>/ventas/realizar_venta.php" class="nav-link">
                            <i class="fas fa-plus-circle"></i>
                            <p>Nueva Venta</p>
                          </a>
                        </li>
                        <li class="nav-item ">
                          <a href="<?php echo $URL;?>/ventas/index1.php" class="nav-link">
                            <i class="fas fa-list"></i>
                            <p>Listado de Ventas</p>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="<?php echo $URL;?>/almacen" class="nav-link">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                Productos
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                        </li>
                    <li class="nav-item ">
                      <a href="<?php echo $URL; ?>/clientes/lista_cliente.php" class="nav-link">  
                        <i class="nav-icon fas fa-users primary-color"></i>
                        <p>
                          Clientes
                          <i class="right fas fa-angle-right"></i>
                        </p>
                      </a>
                     
                    </li>
                    </li>
                    <li class="nav-item ">
                      <a href="<?php echo $URL; ?>/usuarios" class="nav-link">  
                        <i class="nav-icon fas fa-users-cog primary-color"></i>
                        <p>
                          Usuarios
                          <i class="right fas fa-angle-right"></i>
                        </p>
                      </a>
                     
                    </li>

         

                    <li class="nav-item ">
                        <a href="<?php echo $URL;?>/roles" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Roles
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                        
                    </li>


                    <li class="nav-item ">
                        <a href="<?php echo $URL;?>/categorias" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>
                                Categorías
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                       
                    </li>

                    <li class="nav-item ">
                        <a href="<?php echo $URL;?>/bancos/list_movimientos.php" class="nav-link">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>
                                Control
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                       
                    </li>


                   

                    <li class="nav-item ">
                        <a href="<?php echo $URL;?>/compras" class="nav-link">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>
                                Compras
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                        
                    </li>


                    <li class="nav-item ">
                        <a href="<?php echo $URL;?>/proveedores" class="nav-link">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Proveedores
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                     
                    </li>
                    
                    <li class="nav-item ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-import"></i>
                            <p>
                                Reportes
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                     
                    </li>

                    
                    <li class="nav-item ">
                        <a href="<?php echo $URL;?>/configuracion/" class="nav-link">
                            <i class="nav-icon fas fa-app-store"></i>
                            <p>
                                Configuración
                                <i class="right fas fa-angle-right"></i>
                            </p>
                        </a>
                     
                    </li>

                    <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-truck"></i>
                        <p class="text">Notificaciones</p>
                    </a>
                    </li>

                    








                   
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
