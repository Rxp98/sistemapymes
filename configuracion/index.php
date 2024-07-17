<?php include ('../app/config.php'); ?>
<?php include ('../layout/sesion.php'); ?>

<?php include ('../layout/parte1.php'); 
include ('../app/controllers/roles/listado_de_roles.php');
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <center>
                        <h1 class="m-0">Configuraciones del Sistema</h1>
                        
                    </center>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- Gestión de Permisos de Usuario -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Gestión de Permisos de Usuario</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="rol">Rol</label>
                                    <select name="rol" id="" class="form-control">
                                                <?php
                                                foreach ($roles_datos as $roles_dato){?>
                                                     <option value="<?php echo $roles_dato['id_rol'];?>"><?php echo $roles_dato['rol'];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                </div>
                                <div class="form-group">
                                    <label>Funciones Permitidas</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="funciones[]" value="ventas"> Ventas
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="funciones[]" value="usuarios"> Usuarios
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="funciones[]" value="productos"> Productos
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="funciones[]" value="compras"> Compras
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="funciones[]" value="proveedores"> Proveedores
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="funciones[]" value="clientes"> Clientes
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="funciones[]" value="reportes"> Reportes
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="funciones[]" value="inventarios"> Inventarios
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Guardar Configuraciones
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Parámetros del Sistema -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Parámetros del Sistema</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="horariosCheck" name="horariosCheck">
                                <label class="form-check-label" for="horariosCheck">Configurión1</label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="unidadesMedidaCheck" name="unidadesMedidaCheck">
                                <label class="form-check-label" for="unidadesMedidaCheck">Configuración2</label>
                            </div>
                        </div>
                    </div>

                    <!-- Aplicar Precio Mayorista -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Configurar Ventas</h3>
                        </div>
                        <div class="card-body">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="precioMayoristaSwitch" name="precioMayoristaSwitch">
                                <label class="custom-control-label" for="precioMayoristaSwitch">Activar Precio Mayorista</label>
                            </div>
                            <div class="custom-control custom-switch mt-2">
                                <input type="checkbox" class="custom-control-input" id="creditoSwitch" name="creditoSwitch">
                                <label class="custom-control-label" for="creditoSwitch">Activar Crédito</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Personalización del Sistema -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Personalización del Sistema</h3>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                                <label for="logotipo">Nombre del Negocio</label>
                                <input type="text" class="form-control" id="logotipo" name="logotipo">
                            </div>
                            <div class="form-group">
                                <label for="logotipo">Logotipo</label>
                                <input type="file" class="form-control" id="logotipo" name="logotipo">
                            </div>

                            <div class="form-group">
                                <label for="colores">Colores</label>
                                <input type="color" class="form-control" id="colores" name="colores">
                            </div>
                            <a href="config.php" class="btn btn-warning mr-2">
                                <i class="fas fa-file-alt"></i> Recibos
                            </a>
                        </div>
                    </div>

                    
                    <!-- Opciones de Impresora -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Opciones de Impresora</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="tipo_impresora">Tipo de Impresora</label>
                                <select class="form-control" id="tipo_impresora" name="tipo_impresora">
                                    <option value="tmu220">TMU220</option>
                                    <option value="termica">HP-555</option>
                                    <option value="otros">Otros</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Backup y Restauración de Datos -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Backup y Restauración de Datos</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="backup">Realizar Backup</label>
                                <button type="button" class="btn btn-primary" id="backup" name="backup">
                                    <i class="fas fa-database"></i> Backup
                                </button>
                            </div>
                            <div class="form-group">
                                <label for="restauracion">Restaurar Datos</label>
                                <input type="file" class="form-control" id="restauracion" name="restauracion">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


