<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_ingreso = $_POST['id_ingreso'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $responsable_entrega = $_POST['responsable_entrega'];
    $responsable_recibir = $_POST['responsable_recibir'];
    $monto_ingreso = str_replace('.', '', $_POST['monto_ingreso']); // Quitar separadores de miles
    $numero_comprobante = $_POST['numero_comprobante'];
    $observaciones = $_POST['observaciones'];

    if (!empty($id_ingreso) && !empty($fecha_ingreso) && !empty($responsable_entrega) && !empty($responsable_recibir) && !empty($monto_ingreso) && !empty($numero_comprobante) && !empty($observaciones)) {
        try {
            $sql = "UPDATE tb_ingresos SET fecha_ingreso = :fecha_ingreso, responsable_entrega = :responsable_entrega, responsable_recibir = :responsable_recibir, monto_ingreso = :monto_ingreso, numero_comprobante = :numero_comprobante, observaciones = :observaciones WHERE id_ingreso = :id_ingreso";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);
            $stmt->bindParam(':responsable_entrega', $responsable_entrega);
            $stmt->bindParam(':responsable_recibir', $responsable_recibir);
            $stmt->bindParam(':monto_ingreso', $monto_ingreso);
            $stmt->bindParam(':numero_comprobante', $numero_comprobante);
            $stmt->bindParam(':observaciones', $observaciones);
            $stmt->bindParam(':id_ingreso', $id_ingreso);

            if ($stmt->execute()) {
                $_SESSION['mensaje'] = "Ingreso actualizado correctamente";
                $_SESSION['icono'] = "success";
            } else {
                $_SESSION['mensaje'] = "Error al actualizar el ingreso";
                $_SESSION['icono'] = "error";
            }
        } catch (PDOException $e) {
            $_SESSION['mensaje'] = "Error: " . $e->getMessage();
            $_SESSION['icono'] = "error";
        }
    } else {
        $_SESSION['mensaje'] = "Todos los campos son obligatorios";
        $_SESSION['icono'] = "warning";
    }
}

header('Location: ../../../ingresos/list_ingresos.php');
?>