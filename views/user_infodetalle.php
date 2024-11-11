<?php
session_start();
require_once '../conexion.php';
require_once '../models/contenido.php';

if (!isset($_GET['id'])) {
    header("Location: tu_archivo_actual.php"); // Redirige si no hay ID
    exit;
}

$modeloContenido = new modelocontenido($conexion);
$id = intval($_GET['id']); // Convierte el ID a un número entero

// Obtener el contenido específico por ID
$contenido = $modeloContenido->obtenerContenidoPorId($id);

if (!$contenido) {
    echo "Contenido no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Contenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
            padding: 20px;
        }
        .content-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #28a745;
            color: #ffffff;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="content-container">
    <h2><?php echo htmlspecialchars($contenido['titulo']); ?></h2>
    <p><strong>Descripción:</strong> <?php echo htmlspecialchars($contenido['descripcion']); ?></p>
    <p><strong>Tipo:</strong> <?php echo htmlspecialchars($contenido['tipo']); ?></p>
    <?php if ($contenido['archivo']): ?>
        <p><strong>Archivo:</strong> <a href="../documentos/<?php echo htmlspecialchars($contenido['archivo']); ?>" target="_blank">Ver archivo</a></p>
    <?php else: ?>
        <p><strong>Archivo:</strong> No hay archivo disponible</p>
    <?php endif; ?>
    <a href="usu_index.php" class="btn btn-secondary">Volver</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
