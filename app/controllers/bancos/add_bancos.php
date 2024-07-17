<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_banco = $_POST['nombre_banco'];
    $numero_cuenta = $_POST['numero_cuenta'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO tb_bancos (nombre_banco, numero_cuenta, direccion, telefono) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    session_start();
    if ($stmt->execute([$nombre_banco, $numero_cuenta, $direccion, $telefono])) {
        $_SESSION['mensaje'] = "Se registró el banco correctamente";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error: no se pudo registrar el banco en la base de datos";
        $_SESSION['icono'] = "error";
    }
    header('Location: ../../../bancos/list_bancos.php');
    exit();
} else {
    header('Location: ../../../bancos/list_bancos.php');
    exit();
}
?>
