<?php
include ('../../config.php');

// Variables recibidas del formulario
$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$seccion = $_POST['seccion'];
$ubicacion = $_POST['ubicacion'];
$iva = $_POST['iva'];
$precio_mayor1 = $_POST['precio_mayor1'];
$cantidad_mayor1 = $_POST['cantidad_mayor1'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];

// Procesamiento de números con separador de miles y decimales
$stock = str_replace(',', '', $stock); // Elimina cualquier separador de miles
$stock_minimo = str_replace(',', '', $stock_minimo);
$stock_maximo = str_replace(',', '', $stock_maximo);
$precio_compra = str_replace(',', '', $precio_compra);
$precio_venta = str_replace(',', '', $precio_venta);
$precio_mayor1 = str_replace(',', '', $precio_mayor1);
$cantidad_mayor1 = str_replace(',', '', $cantidad_mayor1);

// Procesamiento de la imagen
$nombreDelArchivo = date("Y-m-d-h-i-s");
$filename = $nombreDelArchivo . "__" . $_FILES['image']['name'];
$location = "../../../almacen/img_productos/" . $filename;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preparación y ejecución de la consulta SQL
    $sentencia = $pdo->prepare("INSERT INTO tb_almacen
        (codigo, nombre, marca, seccion, ubicacion, descripcion, stock, stock_minimo, stock_maximo, iva, precio_compra, precio_venta, precio_mayor1, cantidad_mayor1, fecha_ingreso, imagen, id_usuario, id_categoria, fyh_creacion) 
        VALUES (:codigo, :nombre, :marca, :seccion, :ubicacion, :descripcion, :stock, :stock_minimo, :stock_maximo, :iva, :precio_compra, :precio_venta, :precio_mayor1, :cantidad_mayor1, :fecha_ingreso, :imagen, :id_usuario, :id_categoria, :fyh_creacion)");

    $sentencia->bindParam(':codigo', $codigo);
    $sentencia->bindParam(':nombre', $nombre);
    $sentencia->bindParam(':marca', $marca);
    $sentencia->bindParam(':seccion', $seccion);
    $sentencia->bindParam(':ubicacion', $ubicacion);
    $sentencia->bindParam(':descripcion', $descripcion);
    $sentencia->bindParam(':stock', $stock, PDO::PARAM_INT); // Asignamos PDO::PARAM_INT para números enteros
    $sentencia->bindParam(':stock_minimo', $stock_minimo, PDO::PARAM_INT);
    $sentencia->bindParam(':stock_maximo', $stock_maximo, PDO::PARAM_INT);
    $sentencia->bindParam(':precio_compra', $precio_compra, PDO::PARAM_STR); // Dependiendo del tipo de dato en la base de datos
    $sentencia->bindParam(':iva', $iva);
    $sentencia->bindParam(':precio_venta', $precio_venta, PDO::PARAM_STR);
    $sentencia->bindParam(':precio_mayor1', $precio_mayor1, PDO::PARAM_STR);
    $sentencia->bindParam(':cantidad_mayor1', $cantidad_mayor1, PDO::PARAM_INT); // O PDO::PARAM_STR dependiendo de la estructura de la base de datos
    $sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
    $sentencia->bindParam(':imagen', $filename);
    $sentencia->bindParam(':id_usuario', $id_usuario);
    $sentencia->bindParam(':id_categoria', $id_categoria);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);

    // Movimiento de la imagen al directorio
    if (move_uploaded_file($_FILES['image']['tmp_name'], $location)) {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se registró el producto correctamente";
            $_SESSION['icono'] = "success";
            header('Location: ' . $URL . '/almacen/create.php');
            exit();
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al registrar el producto en la base de datos";
            $_SESSION['icono'] = "error";
            header('Location: ' . $URL . '/almacen/create.php');
            exit();
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al subir la imagen";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/almacen/create.php');
        exit();
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Método de solicitud no válido";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/almacen/create.php');
    exit();
}
?>
