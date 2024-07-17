<?php
include('../../config.php');

// Verificar que se hayan enviado los datos necesarios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_movimiento = $_POST['id_movimiento'];
    $tipo_movimiento = $_POST['tipo_movimiento'];
    $monto = str_replace('.', '', $_POST['monto']); // Quitar separadores de miles
    $fecha_movimiento = $_POST['fecha_movimiento'];
    $descripcion = $_POST['descripcion'];
    $cuenta_bancaria = $_POST['cuenta_bancaria'];
    $banco = $_POST['banco'];
    $referencia = $_POST['referencia'];

    // Validar que no estén vacíos los campos necesarios
    if (!empty($tipo_movimiento) && !empty($monto) && !empty($fecha_movimiento) && !empty($descripcion) && !empty($cuenta_bancaria) && !empty($banco) && !empty($referencia)) {
        try {
            $sql = "UPDATE tb_movimientos_bancarios 
                    SET tipo_movimiento = :tipo_movimiento, 
                        monto = :monto, 
                        fecha_movimiento = :fecha_movimiento, 
                        descripcion = :descripcion, 
                        cuenta_bancaria = :cuenta_bancaria, 
                        banco = :banco, 
                        referencia = :referencia 
                    WHERE id_movimiento = :id_movimiento";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':tipo_movimiento', $tipo_movimiento);
            $stmt->bindParam(':monto', $monto);
            $stmt->bindParam(':fecha_movimiento', $fecha_movimiento);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':cuenta_bancaria', $cuenta_bancaria);
            $stmt->bindParam(':banco', $banco);
            $stmt->bindParam(':referencia', $referencia);
            $stmt->bindParam(':id_movimiento', $id_movimiento);

            if ($stmt->execute()) {
                $_SESSION['mensaje'] = "Movimiento actualizado correctamente";
                $_SESSION['icono'] = "success";
            } else {
                $_SESSION['mensaje'] = "Error al actualizar el movimiento";
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
} else {
    $_SESSION['mensaje'] = "Solicitud no válida";
    $_SESSION['icono'] = "error";
}

header('Location: ../../../bancos/list_movimientos.php');
?>
