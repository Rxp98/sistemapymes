<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_egreso = $_POST['id_egreso'];
    $fecha_operacion = $_POST['fecha_operacion'];
    $responsable_operacion = $_POST['responsable_operacion'];
    $recibo_dinero = $_POST['recibo_dinero'];
    $monto = str_replace('.', '', $_POST['monto']);  // Eliminar separadores de miles
    $concepto = $_POST['concepto'];
    $observaciones = $_POST['observaciones'];

    // Actualizar en la base de datos
    $sql = "UPDATE tb_egresos SET fecha_operacion = ?, responsable_operacion = ?, recibo_dinero = ?, monto = ?, concepto = ?, observaciones = ? WHERE id_egreso = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fecha_operacion, $responsable_operacion, $recibo_dinero, $monto, $concepto, $observaciones, $id_egreso]);

    $_SESSION['mensaje'] = "Egreso actualizado correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ../../../egresos/list_egresos.php');
    exit();
}
?>
