<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_factura = $_POST['id_factura'];
    $proveedor = $_POST['proveedor'];
    $metodo_pago = $_POST['metodo_pago'];
    $banco = $_POST['banco'];
    $numero_cheque_transferencia = $_POST['numero_cheque_transferencia'];
    $fecha_emision = $_POST['fecha_emision'];
    $fecha_pago = $_POST['fecha_pago'];
    $monto = str_replace('.', '', $_POST['monto']);  // Eliminar separadores de miles

    // Insertar en la tabla de facturas pagadas
    $sql = "INSERT INTO tb_factura_pagada (id_factura, proveedor, numero_factura, fecha_emision, fecha_pago, monto, metodo_pago, banco, numero_cheque_transferencia) 
            VALUES (?, ?, (SELECT numero_factura FROM tb_facturas_recibidas WHERE id_factura = ?), ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_factura, $proveedor, $id_factura, $fecha_emision, $fecha_pago, $monto, $metodo_pago, $banco, $numero_cheque_transferencia]);

    // Actualizar movimientos bancarios
    $sql_movimiento = "INSERT INTO tb_movimientos_bancarios (tipo_movimiento, monto, fecha_movimiento, descripcion, cuenta_bancaria, banco, referencia) VALUES ('Egreso', ?, ?, ?, ?, ?, ?)";
    $stmt_movimiento = $pdo->prepare($sql_movimiento);
    $stmt_movimiento->execute([$monto, $fecha_pago, $metodo_pago . ' - ' . $numero_cheque_transferencia, 'Cuenta', $banco, $numero_cheque_transferencia]);

    $_SESSION['mensaje'] = "Pago de factura registrado correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ../../../facturas/list_facturas.php');
    exit();
}
?>
