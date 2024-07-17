// search.php
<?php
include('../../config.php');

// Verifica si se ha enviado una solicitud de búsqueda de productos
if (isset($_GET['type']) && $_GET['type'] == 'product') {
    $searchTerm = $_GET['term'];
    $query = "SELECT id_producto, nombre, precio, imagen FROM tb_almacen WHERE nombre LIKE '%$searchTerm%'";
    $result = mysqli_query($conexion, $query);
    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    echo json_encode($products);
    exit;
}

// Verifica si se ha enviado una solicitud de búsqueda de clientes
if (isset($_GET['type']) && $_GET['type'] == 'customer') {
    $searchTerm = $_GET['term'];
    $query = "SELECT id_cliente, nombre FROM clientes WHERE nombre LIKE '%$searchTerm%'";
    $result = mysqli_query($conexion, $query);
    $customers = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }
    echo json_encode($customers);
    exit;
}
?>
