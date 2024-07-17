<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controllers/almacen/listado_de_productos.php');


//include ('../app/controllers/categorias/listado_de_categoria.php');

?> 


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Ventas</title>
    <!-- Incluye el CSS de Bootstrap para los estilos básicos -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Incluye el CSS personalizado -->
    <link rel="stylesheet" href="../css_nuevo/js/sales-form.js">
    <link rel="stylesheet" href="../css_nuevo/index_user.css">
    
    <!-- Incluye jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Ventas</h2>
        <form id="salesForm">
            <!-- Sección de selección de productos -->
            <div class="form-group row">
                <label for="product" class="col-sm-2 col-form-label">Producto:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="product" placeholder="Buscar producto...">
                </div>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="quantity" placeholder="Cantidad">
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary btn-block" id="addProduct">Agregar</button>
                </div>
            </div>
            <!-- Sección de detalles del cliente -->
            <div class="form-group row">
                <label for="customer" class="col-sm-2 col-form-label">Cliente:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="customer" placeholder="Buscar cliente...">
                </div>
            </div>
            <!-- Sección de resumen de la venta -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered" id="salesTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                            <th>IVA</th>
                            <th>Total con IVA</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Filas dinámicas de productos -->
                    </tbody>
                </table>
            </div>
            <!-- Sección de total y acciones -->
            <div class="form-group row">
                <label for="totalIVA" class="col-sm-2 col-form-label">Total IVA:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="totalIVA" readonly>
                </div>
                <label for="grandTotal" class="col-sm-2 col-form-label">Total General:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="grandTotal" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3">
                    <button type="button" class="btn btn-info btn-block" id="holdSale">Enviar en Espera</button>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-warning btn-block" id="addToAccount">Agregar a la Cuenta</button>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-secondary btn-block" id="makeOrder">Pedidos</button>
                </div>
                
                <div class="col-sm-3">
                    <button type="button" class="btn btn-primary btn-block" id="quoteSale">Presupuestar</button>
                </div>
            </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-danger btn-block" id="cancelSale">Cancelar Venta</button>
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success btn-block">Finalizar Venta</button>
                </div>
            </div>
          
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="sales-form.js"></script>
</body>
</html>

<?php include '../layout/parte2.php'; ?>