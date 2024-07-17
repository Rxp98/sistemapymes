<?php
require 'db.php';

// Función para obtener los detalles de una venta
function obtenerDetallesPorVentaId($pdo, $venta_id) {
    $stmt = $pdo->prepare('SELECT * FROM tb_detalles_ventas WHERE id_venta = ?');
    $stmt->execute([$venta_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para crear un nuevo detalle de venta
function crearDetalleVenta($pdo, $venta_id, $producto_id, $cantidad, $precio, $subtotal) {
    $stmt = $pdo->prepare('INSERT INTO tb_detalles_ventas (venta_id, producto_id, cantidad, precio, subtotal) VALUES (?, ?, ?, ?, ?)');
    return $stmt->execute([$venta_id, $producto_id, $cantidad, $precio, $subtotal]);
}

// Función para actualizar un detalle de venta
function actualizarDetalleVenta($pdo, $id, $venta_id, $producto_id, $cantidad, $precio, $subtotal) {
    $stmt = $pdo->prepare('UPDATE tb_detalles_ventas SET venta_id = ?, producto_id = ?, cantidad = ?, precio = ?, subtotal = ? WHERE id = ?');
    return $stmt->execute([$venta_id, $producto_id, $cantidad, $precio, $subtotal, $id]);
}

// Función para eliminar un detalle de venta
function eliminarDetalleVenta($pdo, $id) {
    $stmt = $pdo->prepare('DELETE FROM tb_detalles_ventas WHERE id = ?');
    return $stmt->execute([$id]);
}
?>
