<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Obtener configuraciones
$sql = "SELECT * FROM tb_configuraciones WHERE id = 1";
$stmt = $pdo->query($sql);
$configuracion = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Configuraciones</h1>
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
                            <h3 class="card-title">Personalizar Empresa</h3>
                        </div>
                        <div class="card-body">
                            <form action="../app/controllers/configuraciones/update.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nombre_empresa">Nombre de la Empresa</label>
                                    <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control" value="<?php echo $configuracion['nombre_empresa']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $configuracion['direccion']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="logotipo">Logotipo</label>
                                    <input type="file" name="logotipo" id="logotipo" class="form-control">
                                    <img src="<?php echo $configuracion['logotipo']; ?>" alt="Logotipo" height="50">
                                </div>
                                <div class="form-group">
                                    <label for="ancho_recibo">Ancho del Recibo (cm)</label>
                                    <input type="number" name="ancho_recibo" id="ancho_recibo" class="form-control" value="21" required>
                                </div>
                                <div class="form-group">
                                    <label for="alto_recibo">Alto del Recibo (cm)</label>
                                    <input type="number" name="alto_recibo" id="alto_recibo" class="form-control" value="15" required>
                                </div>
                                <div class="form-group text-right">
                                    <a href="index.php" class="btn btn-danger">..Cancelar</a>
                                    <button type="submit" class="btn btn-info">Guardar Configuraciones</button>
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

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>
