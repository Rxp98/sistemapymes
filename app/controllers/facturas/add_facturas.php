<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_proveedor = $_POST['id_proveedor'];
    $numero_factura = $_POST['numero_factura'];
    $fecha_emision = $_POST['fecha_emision'];
    $fecha_recepcion = $_POST['fecha_recepcion'];
    $condicion = $_POST['condicion'];
    $local_recepcion = $_POST['local_recepcion'];
    $monto_total = $_POST['monto_total'];
    $compra_iva = $_POST['compra_iva'];
    $monto_descuento_nota_credito = $_POST['monto_descuento_nota_credito'] ?: 0.00;
    $monto_otro_descuento = $_POST['monto_otro_descuento'] ?: 0.00;
    $descripcion_otro_descuento = $_POST['descripcion_otro_descuento'] ?: NULL;
    $monto_final = $_POST['monto_final'];
    $fecha_pago = $_POST['fecha_pago'] ?: NULL;
    $observaciones = $_POST['observaciones'] ?: NULL;

    $sql = "INSERT INTO tb_facturas_recibidas (id_proveedor, numero_factura, fecha_emision, fecha_recepcion, condicion, local_recepcion, monto_total, compra_iva, monto_descuento_nota_credito, monto_otro_descuento, descripcion_otro_descuento, monto_final, fecha_pago, observaciones)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    session_start();
    if ($stmt->execute([$id_proveedor, $numero_factura, $fecha_emision, $fecha_recepcion, $condicion, $local_recepcion, $monto_total, $compra_iva, $monto_descuento_nota_credito, $monto_otro_descuento, $descripcion_otro_descuento, $monto_final, $fecha_pago, $observaciones])) {
        $_SESSION['mensaje'] = "Factura registrada correctamente";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al registrar la factura";
        $_SESSION['icono'] = "error";
    }
    header('Location: ../../../facturas_recibidas/add_factura.php');
    exit();
} else {
    header('Location: ../../../facturas_recibidas/lista_facturas.php');
    exit();
}
?>
