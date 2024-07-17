<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_banco'])) {
    $id_banco = $_POST['id_banco'];
    $nombre_banco = $_POST['nombre_banco'];
    $numero_cuenta = $_POST['numero_cuenta'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    $sql = "UPDATE tb_bancos SET nombre_banco = ?, numero_cuenta = ?, direccion = ?, telefono = ? WHERE id_banco = ?";
    $stmt = $pdo->prepare($sql);

    session_start();
    if ($stmt->execute([$nombre_banco, $numero_cuenta, $direccion, $telefono, $id_banco])) {
        $_SESSION['mensaje'] = "Se actualizó el banco correctamente";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error: no se pudo actualizar el banco en la base de datos";
        $_SESSION['icono'] = "error";
    }
    header('Location: ../../../bancos/list_bancos.php');
    exit();
} else {
    header('Location: ../../../bancos/list_bancos.php');
    exit();
}
?>
