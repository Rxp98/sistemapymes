<?php


include ('../../config.php');

$id_categoria = $_POST['id_categoria'];

$sentencia = $pdo->prepare("DELETE FROM tb_categorias WHERE id_categoria=:id_categoria ");

$sentencia->bindParam('id_categoria',$id_categoria);
if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se eliminó de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: '.$URL.'/categorias/index.php');
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar el registro en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/categorias/index.php?id='.$id_categoria);
}
