<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_egreso = $_POST['id_egreso'];

    // Eliminar de la base de datos
    $sql = "DELETE FROM tb_egresos WHERE id_egreso = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_egreso]);

    $_SESSION['mensaje'] = "Egreso eliminado correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ../../../egresos/list_egresos.php');
    exit();
}
?>
