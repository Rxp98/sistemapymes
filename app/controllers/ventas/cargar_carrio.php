<?php
include ('../../config.php');

// Verificar si las variables GET están definidas
if (isset($_GET['nro_venta']) && isset($_GET['id_producto']) && isset($_GET['cantidad'])) {
    $nro_venta = $_GET['nro_venta'];
    $id_producto = $_GET['id_producto'];
    $cantidad = $_GET['cantidad'];

    // Verificar que los valores no están vacíos
    if (!empty($nro_venta) && !empty($id_producto) && !empty($cantidad)) {
        try {
            // Preparar la sentencia SQL
            $sentencia = $pdo->prepare("INSERT INTO tb_carrito (nro_venta, id_producto, cantidad, fyh_creacion) VALUES (:nro_venta, :id_producto, :cantidad, :fyh_creacion)");

            // Vincular los parámetros
            $fyh_creacion = date('Y-m-d H:i:s');
            $sentencia->bindParam(':nro_venta', $nro_venta);
            $sentencia->bindParam(':id_producto', $id_producto);
            $sentencia->bindParam(':cantidad', $cantidad);
            $sentencia->bindParam(':fyh_creacion', $fyh_creacion);

            // Ejecutar la sentencia
            if ($sentencia->execute()) {
                echo "Producto agregado al carrito correctamente.";
            } else {
                echo "Error al agregar el producto al carrito.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error: Todos los campos son obligatorios.";
    }
} else {
    echo "Error: Faltan datos necesarios.";
}
?>
