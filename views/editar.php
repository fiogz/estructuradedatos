<?php
session_start();
require_once '../conexion.php';
require_once '../models/contenido.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}

$modeloContenido = new modelocontenido($conexion);

// Verificar si se envió un ID por la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $contenido = $modeloContenido->obtenerContenidoPorId($id);

    if (!$contenido) {
        echo "El contenido no existe.";
        exit;
    }
}

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tipo = $_POST['tipo'];
    
    // Verificar si se ha subido un archivo nuevo
    if (!empty($_FILES['archivo']['name'])) {
        $nombreArchivo = basename($_FILES['archivo']['name']);
        $rutaDestino = "../documentos/" . $nombreArchivo;
        
        // Mover el archivo a la carpeta 'documentos'
        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaDestino)) {
            $archivo = $nombreArchivo;
        } else {
            echo "Error al subir la imagen.";
            exit;
        }
    } else {
        // Si no se sube un archivo nuevo, mantener el archivo existente
        $archivo = $contenido['archivo'];
    }

    // Llamar al método para actualizar el contenido
    if ($modeloContenido->actualizarContenido($id, $titulo, $descripcion, $tipo, $archivo)) {
        header("Location: ver_contenido.php");
        exit;
    } else {
        echo "Error al actualizar el contenido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2>Editar Contenido</h2>
    <form action="editar.php?id=<?php echo htmlspecialchars($contenido['id']); ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($contenido['id']); ?>">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($contenido['titulo']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($contenido['descripcion']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo htmlspecialchars($contenido['tipo']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="archivo" class="form-label">Cambiar Documento o Imagen (opcional)</label>
            <input type="file" class="form-control" id="archivo" name="archivo" accept=".pdf,.doc,.docx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif">
        </div>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="ver_contenido.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
