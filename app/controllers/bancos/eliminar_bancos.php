<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_banco'])) {
    $id_banco = $_POST['id_banco'];

    $sql = "DELETE FROM tb_bancos WHERE id_banco = ?";
    $stmt = $pdo->prepare($sql);

    session_start();
    if ($stmt->execute([$id_banco])) {
        $_SESSION['mensaje'] = "Se eliminó el banco correctamente";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error: no se pudo eliminar el banco en la base de datos";
        $_SESSION['icono'] = "error";
    }
    header('Location: ../../../bancos/list_bancos.php');
    exit();
} else {
    header('Location: ../../../bancos/list_bancos.php');
    exit();
}
?>
