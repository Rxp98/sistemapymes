<?php


include ('../../config.php');

$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$marca= $_POST['marca'];
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
$id_producto = $_POST['id_producto'];


if($_FILES['image']['name'] != null){
    //echo "hay imagen nueva";
    $nombreDelArchivo = date("Y-m-d-h-i-s");
    $image_text = $nombreDelArchivo."__".$_FILES['image']['name'];
    $location = "../../../almacen/img_productos/".$image_text;
    move_uploaded_file($_FILES['image']['tmp_name'],$location);
}else{
   // echo "no hay imagen";
}


$sentencia = $pdo->prepare("UPDATE tb_almacen
    SET nombre=:nombre,
    marca=:marca,
    cantidad_mayor1=:cantidad_mayor1,
        
    seccion=:seccion,
    ubicacion=:ubicacion,
    iva=:iva,
    precio_mayor1=:precio_mayor1,
    
        descripcion=:descripcion,
        stock=:stock,
        stock_minimo=:stock_minimo,
        stock_maximo=:stock_maximo,
        precio_compra=:precio_compra,
        precio_venta=:precio_venta,
        fecha_ingreso=:fecha_ingreso,
        imagen=:imagen,
        id_usuario=:id_usuario,
        id_categoria=:id_categoria,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_producto = :id_producto ");

$sentencia->bindParam('nombre',$nombre);
$sentencia->bindParam('marca',$marca);
$sentencia->bindParam('seccion',$seccion);
$sentencia->bindParam('ubicacion',$ubicacion);
$sentencia->bindParam('iva',$iva);
$sentencia->bindParam('precio_mayor1',$precio_mayor1);
$sentencia->bindParam('cantidad_mayor1',$cantidad_mayor1);


$sentencia->bindParam('descripcion',$descripcion);
$sentencia->bindParam('stock',$stock);
$sentencia->bindParam('stock_minimo',$stock_minimo);
$sentencia->bindParam('stock_maximo',$stock_maximo);
$sentencia->bindParam('precio_compra',$precio_compra);
$sentencia->bindParam('precio_venta',$precio_venta);
$sentencia->bindParam('fecha_ingreso',$fecha_ingreso);
$sentencia->bindParam('imagen',$image_text);
$sentencia->bindParam('id_usuario',$id_usuario);
$sentencia->bindParam('id_categoria',$id_categoria);
$sentencia->bindParam('fyh_actualizacion',$fechaHora);
$sentencia->bindParam('id_producto',$id_producto);

if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el producto de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: '.$URL.'/almacen/');
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/almacen/update.php?id='.$id_producto);
}



