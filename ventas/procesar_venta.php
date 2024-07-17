<?php
include '../app/config.php';

$id_producto = $_POST['nommbre'];
$cantidad = $_POST['cantidad'];
$cliente = $_POST['cliente'];
$moneda = $_POST['moneda'];

$query = "INSERT INTO ventas (producto_id, cantidad, cliente, moneda) VALUES ('$producto_id', '$cantidad', '$cliente', '$moneda')";
if ($conn->query($query) === TRUE) {
    echo "Venta registrada exitosamente";
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$conn->close();
?>
