<?php
// Incluye el archivo de conexión a la base de datos


// Consulta SQL para seleccionar clientes de la tabla 'tb_clientes'
$sql_clientes = "SELECT id_cliente, nombre, documento, direccion, telefono, limite_credito, fecha_pago, observaciones FROM tb_clientes";
$query_clientes = $pdo->prepare($sql_clientes);
$query_clientes->execute();
$clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);

// Muestra los datos de los clientes
foreach ($clientes_datos as $cliente) {
    echo "ID: " . $cliente['id_cliente'] . "<br>";
    echo "Nombre: " . $cliente['nombre'] . "<br>";
    echo "Documento: " . $cliente['documento'] . "<br>";
    echo "Dirección: " . $cliente['direccion'] . "<br>";
    echo "Teléfono: " . $cliente['telefono'] . "<br>";
    echo "Límite de Crédito: " . $cliente['limite_credito'] . "<br>";
    echo "Fecha de Pago: " . $cliente['fecha_pago'] . "<br>";
    echo "Observaciones: " . $cliente['observaciones'] . "<br><br>";
}
?>
