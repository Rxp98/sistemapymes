<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/almacen/listado_de_productos.php');
include('../app/controllers/categorias/listado_de_categoria.php');
include('../app/controllers/proveedores/listado_de_proveedores.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de Productos</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ingrese los datos</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="../app/controllers/almacen/create.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="codigo">Código:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                        </div>
                                                        <?php
                                                        function ceros($numero) {
                                                            $len = 0;
                                                            $cantidad_ceros = 5;
                                                            $aux = $numero;
                                                            $pos = strlen($numero);
                                                            $len = $cantidad_ceros - $pos;
                                                            for ($i = 0; $i < $len; $i++) {
                                                                $aux = "0" . $aux;
                                                            }
                                                            return $aux;
                                                        }
                                                        $contador_de_id_productos = 1;
                                                        foreach ($productos_datos as $productos_dato) {
                                                            $contador_de_id_productos++;
                                                        }
                                                        ?>
                                                        <input type="text" class="form-control" value="<?php echo "P-" . ceros($contador_de_id_productos); ?>" disabled>
                                                        <input type="hidden" name="codigo" value="<?php echo "P-" . ceros($contador_de_id_productos); ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nombre">Nombre del producto:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                        </div>
                                                        <input type="text" name="nombre" class="form-control text-center" required autofocus>
                                                    </div>
                                                    <ul id="suggestionsNombreProducto" class="suggestions"></ul>
                                                </div>
                                                <div class="form-group">
                                                    <label for="categoria">Categoría:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-list"></i></span>
                                                        </div>
                                                        <select name="id_categoria" class="form-control text-center" required>
                                                            <?php foreach ($categorias_datos as $categorias_dato) { ?>
                                                                <option value="<?php echo $categorias_dato['id_categoria']; ?>"><?php echo $categorias_dato['nombre_categoria']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <a href="<?php echo $URL; ?>/categorias" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="seccion">Sección:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-th-large"></i></span>
                                                        </div>
                                                        <input type="text" name="seccion" class="form-control text-center" required>
                                                    </div>
                                                    <ul id="suggestionsSeccion" class="suggestions"></ul>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ubicacion">Ubicación:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                         </div>
                                                        <input type="text" name="ubicacion" class="form-control text-center" required>
                                                    </div>
                                                    <ul id="suggestionsUbicacion" class="suggestions"></ul>
                                                </div>
                                                <div class="form-group">
                                                    <label for="proveedor">Proveedor:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-truck"></i></span>
                                                        </div>
                                                        <select name="id_proveedor" class="form-control" required>
                                                            <?php foreach ($proveedores_datos as $proveedores_dato) { ?>
                                                                <option value="<?php echo $proveedores_dato['id_proveedor']; ?>"><?php echo $proveedores_dato['nombre_proveedor']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <a href="<?php echo $URL; ?>/proveedores" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="marca">Marca:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                                        </div>
                                                        <input type="text" name="marca" class="form-control text-center" required>
                                                    </div>
                                                    <ul id="suggestionsMarca" class="suggestions"></ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="descripcion">Descripción del producto (opcional):</label>
                                                    <textarea name="descripcion" class="form-control text-center" rows="1"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="stock">Stock:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                                                        </div>
                                                        <input type="number" name="stock" class="form-control text-center" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="stock_minimo">Stock mínimo:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-exclamation-circle"></i></span>
                                                        </div>
                                                        <input type="number" name="stock_minimo" class="form-control text-center" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="stock_maximo">Stock máximo:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-exclamation-triangle"></i></span>
                                                        </div>
                                                        <input type="number" name="stock_maximo" class="form-control text-center" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="iva">IVA:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                                        </div>
                                                        <select name="iva" class="form-control text-center" required>
                                                            <option value="5">5</option>
                                                            <option value="10">10</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="numeric_value">Precio compra:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                        </div>
                                                        <input type="number" name="precio_compra" id="" class="form-control text-center" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="numeric_value">Precio venta:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                        </div>
                                                        <input type="number" name="precio_venta" id="" class="form-control text-center" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="numeric_value">Precio Mayorista:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                        </div>
                                                        <input type="number" name="precio_mayor1" id="" class="form-control text-center">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="cantidad_mayor1">Cantidad Mayorista:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                                                        </div>
                                                        <input type="number" name="cantidad_mayor1" class="form-control text-center">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha_ingreso">Fecha de vencimiento:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="date" name="fecha_ingreso" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Usuario Responsable:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" value="<?php echo $email_sesion; ?>" disabled>
                                                        <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Imagen:</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                                        </div>
                                                        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                                                    </div>
                                                    <div class="mt-2">
                                                        <img id="outputImage" width="200" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-right">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar Producto</button>
                                            <button type="reset" class="btn btn-secondary"><i class="fa fa-eraser"></i> Limpiar</button>
                                            <a href="index.php" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('outputImage');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function formatNumber(input) {
    // Eliminar los separadores de miles actuales (puntos)
    var value = input.value.replace(/\./g, '');
    
    // Verificar si el valor restante es numérico
    if (!isNaN(value)) {
        // Formatear el número según el estilo alemán
        input.value = new Intl.NumberFormat('de-DE').format(value);
    }
}
document.getElementById('numeric_value').addEventListener('input', function(event) {
            let value = event.target.value;
            value = value.replace(/\D/g, ''); // Eliminar cualquier carácter que no sea un dígito
            event.target.value = value;
        });
// Agregar el evento blur a todos los campos de texto
document.querySelectorAll('input[type="text"]').forEach(function(input) {
    input.addEventListener('blur', function() {
        formatNumber(input);
    });
});

document.querySelector('input[name="nombre"]').setAttribute("autocomplete", "on");
document.querySelector('input[name="seccion"]').setAttribute("autocomplete", "on");
document.querySelector('input[name="ubicacion"]').setAttribute("autocomplete", "on");
document.querySelector('input[name="marca"]').setAttribute("autocomplete", "on");
</script>
