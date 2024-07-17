<?php
include('../../config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_movimiento'])) {
    $id_movimiento = $_POST['id_movimiento'];
    //$id_usuario_sesion = $_SESSION['id_usuario_sesion'];

    $sql = "DELETE FROM tb_movimientos_bancarios WHERE id_movimiento = ?";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$id_movimiento])) {
        $_SESSION['mensaje'] = "Se eliminó el movimiento bancario correctamente";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error: no se pudo eliminar el movimiento bancario en la base de datos";
        $_SESSION['icono'] = "error";
    }
    header('Location: ../../../bancos/list_movimientos.php');
    exit();
} else {
    header('Location: ../../../bancos/list_movimientos.php');
    exit();
}
?>
