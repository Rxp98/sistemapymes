<?php
require_once '../vendor/autoload.php';
include('../app/config.php');

use Dompdf\Dompdf;
use Dompdf\Options;

// Verificar si el ID de ingreso está en la URL
if (isset($_GET['id'])) {
    $id_ingreso = $_GET['id'];
    // Obtener el ingreso
    $sql = "SELECT * FROM tb_ingresos WHERE id_ingreso = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_ingreso]);
    $ingreso = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el ingreso existe
    if (!$ingreso) {
        $_SESSION['mensaje'] = "Ingreso no encontrado";
        $_SESSION['icono'] = "error";
        header('Location: list_ingresos.php');
        exit();
    }
} else {
    $_SESSION['mensaje'] = "ID de ingreso no especificado";
    $_SESSION['icono'] = "error";
    header('Location: list_ingresos.php');
    exit();
}

// Obtener configuraciones
$sql_config = "SELECT * FROM tb_configuraciones WHERE id = 1";
$stmt_config = $pdo->query($sql_config);
$configuracion = $stmt_config->fetch(PDO::FETCH_ASSOC);

// Establecer tamaño del recibo en centímetros
$ancho_recibo = $configuracion['ancho_recibo']; // Ancho en cm
$alto_recibo = $configuracion['alto_recibo'];  // Alto en cm

// Generar HTML del recibo
$html = '

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Ingreso</title>
    <link rel="stylesheet" href="../css_nuevo/recibo.css">
</head>
<body>
    <div class="recibo">
        <div class="header">
            <div>
                <img src="../../' . $configuracion['logotipo'] . '" alt="Logotipo" height="50">
                <p>' . $configuracion['nombre_empresa'] . '</p>
                <p>' . $configuracion['direccion'] . '</p>
                <p><strong>N°:</strong> ' . $ingreso['numero_comprobante'] . '</p>
                <p><strong>Gs.:</strong> ' . number_format($ingreso['monto_ingreso'], 0, ',', '.') . '</p>
            </div>
           
        </div>
        <h3>RECIBO DE DINERO</h3>
        <p><strong>Asunción,</strong> ' . date('d/m/Y', strtotime($ingreso['fecha_ingreso'])) . '</p>
        <p>Recibí (mos) de <strong>' . $ingreso['responsable_entrega'] . '</strong></p>
        <p>La cantidad de guaraníes:.. <strong>' . number_format($ingreso['monto_ingreso'], 0, ',', '.') . '</strong></p>
        <p>En concepto de pago <strong>' . $ingreso['observaciones'] . '</strong></p>
        <div class="signature">
            <p>Firma y aclaración</p>
            <p><strong>' . $configuracion['nombre_empresa'] . '</strong></p>
        </div>
    </div>
</body>
</html>
';

// Opciones de Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper([0, 0, $ancho_recibo * 28.3465, $alto_recibo * 28.3465]); // Tamaño en puntos
$dompdf->render();

// Guardar PDF en la carpeta recibos
$output = $dompdf->output();
$filename = '../recibos/recibo_' . $id_ingreso . '.pdf';
file_put_contents($filename, $output);

// Mostrar el PDF en una nueva pestaña del navegador
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="recibo_' . $id_ingreso . '.pdf"');
echo $output;
?>
