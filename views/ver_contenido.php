<?php
session_start();
require_once '../conexion.php';
require_once '../models/contenido.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}

// Inicializar modelo y obtener contenidos
$modeloContenido = new modelocontenido($conexion);
$contenidos = $modeloContenido->obtenerContenidos() ?? [];

// A partir de aquí empieza el HTML
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contenidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            color: #1d5461;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .table-container {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            max-width: 800px;
            margin: 20px auto;
            color: #000;
            margin-left: -60px;
        }

    </style></head>
<body>

    <div class="container mt-5 mb-2">
        <h2>Lista de Contenidos Publicados</h2>
        
        <div class="table-container">
        <a href="agregar_con.php" class="btn btn-secondary mb-4">Agregar Contenido</a>
            <a href="admin_index.php" class="btn btn-secondary mb-4">Volver</a> 
         <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Archivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($contenidos && count($contenidos) > 0): ?>
                        <?php foreach ($contenidos as $contenido): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($contenido['id']); ?></td>
                                <td><?php echo htmlspecialchars($contenido['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($contenido['descripcion']); ?></td>
                                <td><?php echo htmlspecialchars($contenido['tipo']); ?></td>
                                <td>
                                    <?php if ($contenido['archivo']): ?>
                                        <a href="../documentos/<?php echo htmlspecialchars($contenido['archivo']); ?>" target="_blank">Ver archivo</a>
                                    <?php else: ?>
                                        No hay archivo
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="editar.php?id=<?php echo htmlspecialchars($contenido['id']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="eliminar.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($contenido['id']); ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este contenido?');">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No hay contenidos disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
         </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
