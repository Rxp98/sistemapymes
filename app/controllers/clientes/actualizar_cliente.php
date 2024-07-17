<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];
    $sql = "SELECT * FROM tb_clientes WHERE id_cliente = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_cliente]);
    $cliente = $stmt->fetch();

    if (!$cliente) {
        // Redirigir si no se encuentra el cliente
        header('Location: ../../../modules/customers/list_customers.php');
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_cliente'])) {
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $documento = $_POST['documento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $limite_credito = $_POST['limite_credito'];
    $fecha_pago = $_POST['fecha_pago'];
    $observaciones = $_POST['observaciones'];

    $sql = "UPDATE tb_clientes SET nombre = ?, documento = ?, direccion = ?, telefono = ?, limite_credito = ?, fecha_pago = ?, observaciones = ? WHERE id_cliente = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $documento, $direccion, $telefono, $limite_credito, $fecha_pago, $observaciones, $id_cliente]);

    session_start();
    if ($stmt->rowCount()) {
        $_SESSION['mensaje'] = "Se actualizó el cliente correctamente";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error: no se pudo actualizar el cliente en la base de datos";
        $_SESSION['icono'] = "error";
    }
    header('Location: ../../../modules/customers/list_customers.php');
    exit();
} else {
    // Redirigir si no se reciben los datos necesarios
    header('Location: ../../../modules/customers/list_customers.php');
    exit();
}
?>
