<?php


include ('../../config.php');

$id_cliente = $_POST['id_cliente'];

$sentencia = $pdo->prepare("DELETE FROM tb_clientes WHERE id_cliente=:id_cliente");

$sentencia->bindParam('id_cliente',$id_cliente);
if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se elimino de manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: '.$URL.'/clientes/lista_php');
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar el registro en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/clientes/borrar_cliente.php?id='.$id_cliente);
}
