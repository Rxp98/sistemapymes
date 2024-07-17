<?php
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha_operacion = $_POST['fecha_operacion'];
    $responsable_operacion = $_POST['responsable_operacion'];
    $recibo_dinero = $_POST['recibo_dinero'];
    $monto = str_replace('.', '', $_POST['monto']);  // Eliminar separadores de miles
    $concepto = $_POST['concepto'];
    $observaciones = $_POST['observaciones'];

    // Insertar en la base de datos
    $sql = "INSERT INTO tb_egresos (fecha_operacion, responsable_operacion, recibo_dinero, monto, concepto, observaciones) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fecha_operacion, $responsable_operacion, $recibo_dinero, $monto, $concepto, $observaciones]);

    $_SESSION['mensaje'] = "Egreso registrado correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ../../../egresos/list_egresos.php');
    exit();
}
?>
