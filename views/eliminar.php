<?php
session_start();
require_once '../conexion.php';
require_once '../models/contenido.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}

$modeloContenido = new modelocontenido($conexion);

// Verificar si se envió un ID por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    if ($modeloContenido->eliminarContenido($id)) {
        header("Location: ver_contenido.php");
        exit;
    } else {
        echo "Error al eliminar el contenido.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
