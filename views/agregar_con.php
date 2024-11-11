<?php 
$servidor = "localhost"; 
$usuario = "root"; 
$contrasena = ""; 
$basededatos = "estructuradatos"; 

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$mensaje = ''; // Inicializa el mensaje

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? null;
    $descripcion = $_POST['descripcion'] ?? null;
    $tipo = $_POST['tipo'] ?? null;
    $archivo = $_FILES['archivo'] ?? null;
    $fk_contenido_usuario = 9; // Cambia este valor por el ID del usuario autenticado

    // Validar que todos los campos requeridos no sean nulos
    if ($titulo && $descripcion && $tipo && $fk_contenido_usuario) {
        try {
            // Insertar contenido en la base de datos
            $stmt = $conexion->prepare("INSERT INTO contenido (titulo, descripcion, tipo, usuario_id) VALUES (:titulo, :descripcion, :tipo, :usuario_id)");
            $stmt->execute(['titulo' => $titulo, 'descripcion' => $descripcion, 'tipo' => $tipo, 'usuario_id' => $fk_contenido_usuario]);

            // Obtener el ID del contenido insertado
            $contenido_id = $conexion->lastInsertId();

            // Manejar archivo si se ha subido
            if ($archivo && $archivo['error'] == UPLOAD_ERR_OK) {
                $rutaDestino = '../documentos/' . basename($archivo['name']);
                move_uploaded_file($archivo['tmp_name'], $rutaDestino);

                // Actualizar información del archivo
                $stmt = $conexion->prepare("UPDATE contenido SET archivo = :archivo WHERE id = :id");
                $stmt->execute(['archivo' => basename($archivo['name']), 'id' => $contenido_id]);
            }

            $mensaje = '<div class="alert alert-success">Contenido agregado exitosamente.</div>';
        } catch (Exception $e) {
            $mensaje = "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    } else {
        $mensaje = "<div class='alert alert-danger'>Todos los campos son requeridos.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Contenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../images/fondo.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #dbeadd;
            color: #153e47;
        }
        .container {
            background-color: rgba(29, 84, 97, 0.8);
            border-radius: 10px;
            padding: 10px;
        }
        .btn-primary {
            background-color: #92b19e;
            border-color: #92b19e;
        }
        .btn-primary:hover {
            background-color: #42808b;
            border-color: #42808b;
        }
        .alert-success {
            background-color: #d5dabe;
            color: #6c503b;
        }
        .alert-danger {
            background-color: #acb295;
            color: #6c503b;
        }
    </style>
</head>
<body>

<div class="container mt-3 text-light">
    <?php echo $mensaje; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Estructura de Datos</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="" disabled selected>Selecciona un tipo...</option>
                <option value="Array">Array</option>
                <option value="Pila">Pila</option>
                <option value="Cola">Cola</option>
                <option value="Lista">Lista</option>
                <option value="Grafo">Grafo</option>
                <option value="Árbol">Árbol</option>
                <option value="Ordenación">Ordenación</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="archivo" class="form-label">Subir Documento o Imagen (opcional)</label>
            <input type="file" class="form-control" id="archivo" name="archivo" accept=".pdf,.doc,.docx,.ppt,.pptx,.txt,.jpg,.jpeg,.png,.gif">
        </div>
        <button type="submit" class="btn btn-primary">Agregar Contenido</button>
        <a href="./admin_index.php" class="btn btn-secondary">Volver</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
