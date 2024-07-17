<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_factura = $_POST['id_factura'];

    $sql = "DELETE FROM tb_facturas_recibidas WHERE id_factura = ?";
    $stmt = $pdo->prepare($sql);

    session_start();
    if ($stmt->execute([$id_factura])) {
        $_SESSION['mensaje'] = "Factura eliminada correctamente";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar la factura";
        $_SESSION['icono'] = "error";
    }
    header('Location: ../../../facturas_recibidas/lista_facturas.php');
    exit();
} else {
    header('Location: ../../../facturas_recibidas/lista_facturas.php');
    exit();
}
?>
