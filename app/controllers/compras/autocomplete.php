<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sistemadeventas";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$term = $_GET['term'];
$field = $_GET['field'];

$sql = "SELECT DISTINCT $field FROM tb_almacen WHERE $field LIKE '%" . $term . "%'";
$result = $conn->query($sql);

$suggestions = array();
while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row[$field];
}

echo json_encode($suggestions);

$conn->close();
?>
