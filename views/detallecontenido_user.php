<?php
session_start();
require_once '../conexion.php';
require_once '../models/contenido.php';

if (!isset($_GET['id'])) {
    header("Location: ver_contenidos.php"); // Redirige si no hay ID
    exit;
}

$modelocontenidos = new modelocontenido($conexion);
$id = intval($_GET['id']); // Convierte el ID a un número entero

// Obtener el contenido específico por ID
$contenidos = $modelocontenidos->obtenercontenidoPorId($id);

if (!$contenidos) {
    echo "Contenido no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de contenidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #dbeadd; /* Color de fondo claro */
            color: #1d5461; /* Color de texto */
            padding: 20px;
        }
        .content-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff; /* Fondo blanco para el contenedor */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #153e47; /* Color para los encabezados */
        }
        .btn-secondary {
            background-color: #acb295; /* Color del botón de volver */
            color: #ffffff;
        }
        .btn-secondary:hover {
            background-color: #92b19e; /* Color de fondo al pasar el ratón */
        }
    </style>
</head>
<body>

<div class="content-container">
    <h2><?php echo htmlspecialchars($contenidos['titulo']); ?></h2>
    <p><strong>Descripción:</strong> <?php echo htmlspecialchars($contenidos['descripcion']); ?></p>
    <p><strong>Tipo:</strong> <?php echo htmlspecialchars($contenidos['tipo']); ?></p>
    <?php if ($contenidos['archivo']): ?>
        <!-- Mostrar el archivo directamente si es una imagen -->
        <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $contenidos['archivo'])): ?>
            <img src="../documentos/<?php echo htmlspecialchars($contenidos['archivo']); ?>" alt="Imagen" class="img-fluid mb-3">
        <?php else: ?>
            <p>No se puede mostrar el archivo, pero puedes <a href="../documentos/<?php echo htmlspecialchars($contenidos['archivo']); ?>" target="_blank">descargarlo aquí</a>.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>No hay archivo disponible.</p>
    <?php endif; ?>
    <a href="usu_index.php" class="btn btn-secondary">Volver</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
