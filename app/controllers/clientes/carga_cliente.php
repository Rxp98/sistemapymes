<?php

// Verificar que el parámetro 'id' se ha pasado y es un número
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_cliente_get = $_GET['id'];

    // Consulta SQL preparada para obtener datos del cliente
    $sql_clientes = "SELECT us.id_cliente as id_cliente, us.nombre as nombre, us.documento as documento, us.direccion as direccion, us.telefono as telefono, us.limite_credito as limite_credito, us.fecha_pago as fecha_pago, us.observaciones as observaciones
                     FROM tb_clientes us 
                     WHERE us.id_cliente = :id_cliente";
    
    // Preparar la consulta
    $query_clientes = $pdo->prepare($sql_clientes);
    
    // Asociar parámetro y ejecutar la consulta
    $query_clientes->bindParam(':id_cliente', $id_cliente_get, PDO::PARAM_INT); 
    $query_clientes->execute();
    
    // Obtener los datos del cliente como arreglo asociativo
    $clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);

    // Si se encontraron datos de cliente
    if ($clientes_datos) {
        // Iterar sobre los resultados (aunque debería ser solo un cliente)
        foreach ($clientes_datos as $clientes_dato) {
            $nombre = $clientes_dato['nombre'];
            $documento = $clientes_dato['documento'];
            $direccion = $clientes_dato['direccion'];
            $telefono = $clientes_dato['telefono'];
            $limite_credito = $clientes_dato['limite_credito'];
            $fecha_pago = $clientes_dato['fecha_pago'];
            $observaciones = $clientes_dato['observaciones'];

            // Aquí puedes utilizar las variables $nombre, $documento, etc.
            // para mostrar o procesar los datos del cliente
        }
    } else {
        // Manejar el caso donde no se encontró ningún cliente con ese id
        echo "No se encontró ningún cliente con el ID proporcionado.";
    }
} else {
    // Manejar el caso donde el parámetro 'id' no es válido
    echo "ID de cliente no válido.";
}
?>
