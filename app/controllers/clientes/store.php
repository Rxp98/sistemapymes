<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $documento = $_POST['documento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $limite_credito = $_POST['limite_credito'];
    $fecha_pago = $_POST['fecha_pago'];
    $observaciones = $_POST['observaciones'];

    $sql = "INSERT INTO tb_clientes (nombre, documento, direccion, telefono, limite_credito, fecha_pago, observaciones) VALUES (?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre, $documento, $direccion, $telefono, $limite_credito, $fecha_pago, $observaciones]);

    header('Location: ../../../clientes/crear_cliente.php');
    exit();
}
?>
