<?php
include('../../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_empresa = $_POST['nombre_empresa'];
    $direccion = $_POST['direccion'];
    $ancho_recibo = $_POST['ancho_recibo'];
    $alto_recibo = $_POST['alto_recibo'];

    // Manejo del logotipo
    $logotipo = $_FILES['logotipo'];
    if ($logotipo['error'] == 0) {
        $logotipo_path = 'uploads/' . basename($logotipo['name']);
        move_uploaded_file($logotipo['tmp_name'], '../../' . $logotipo_path);
    } else {
        $logotipo_path = $configuracion['logotipo'];
    }

    // Actualizar la configuración en la base de datos
    $sql = "UPDATE tb_configuraciones SET nombre_empresa = ?, direccion = ?, logotipo = ?, ancho_recibo = ?, alto_recibo = ? WHERE id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nombre_empresa, $direccion, $logotipo_path, $ancho_recibo, $alto_recibo]);

    $_SESSION['mensaje'] = "Configuraciones actualizadas con éxito";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/configuraciones/config.php');
    exit();
}
?>
