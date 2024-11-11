<?php
session_start(); // Inicia la sesión

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirige al login si no está autenticado
    exit();
}

// Conexión a la base de datos
require_once '../conexion.php'; // Asegúrate de que la ruta sea correcta

// Obtiene el ID del usuario desde la sesión
$usuario_id = $_SESSION['usuario_id'];

// Prepara la consulta para obtener la información del usuario
$query = $conexion->prepare("SELECT nombre, email, contraseña, rol FROM usuarios WHERE id = ?");
$query->execute([$usuario_id]);

// Obtiene el resultado
$usuario = $query->fetch(PDO::FETCH_ASSOC);

// Verifica si se obtuvieron los datos
if (!$usuario) {
    die("Usuario no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1>Perfil de Usuario</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Información del Usuario</h5>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
            <p><strong>Contraseña:</strong> *********** <a href="cambiar_contraseña.php">Cambiar Contraseña</a></p>
            <p><strong>Rol:</strong> <?php echo htmlspecialchars($usuario['rol']); ?></p>
        </div>
    </div>
    <div class="mt-4">
        <a href="editar_perfil.php" class="btn btn-primary">Editar Perfil</a>
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
