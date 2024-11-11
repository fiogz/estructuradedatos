<?php
session_start();
require_once '../conexion.php';
require_once '../models/usuario.php';

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'administrador') {
    header("Location: admin_index.php");
    exit;
}

$usuarioModelo = new usuario($conexion);
$usuarios = []; // Aquí guardarás la lista de usuarios

try {
    $stmt = $conexion->query("SELECT id, nombre, correo, rol FROM usuarios");
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../images/fondo.jpg'); /* Fondo personalizado */
            background-repeat: no-repeat; /* Evita que se repita la imagen */
            background-size: cover; /* Cubre todo el fondo */
            background-color: #343a40; /* Color de fondo alternativo */
            color: #ffffff;
            min-height: 100vh; /* Para que el contenido ocupe al menos el alto de la pantalla */
            display: flex;
            flex-direction: column; /* Hace que los elementos se coloquen en columna */
            margin: 0; /* Elimina el margen por defecto */
        }

        .header {
            background-color: #1d5461;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            color: #ffffff;
        }

        .btn-custom {
            background-color: #acb295;
            color: #212529;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 5px;
        }

        .btn-custom:hover {
            background-color: #92b19e;
            color: #ffffff;
        }

        .content {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            max-width: 800px;
            margin: 20px auto;
            color: #000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        footer {
            background-color: #1d5461;
            color: #ffffff;
            text-align: center;
            padding: 1rem;
            width: 100%;
            margin-top: auto;
        }
        .container{
            color: white;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Lista de Usuarios</h2>
</div>

<div class="container mt-4 content">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="./admin_index.php" class="btn btn-secondary">Volver</a>
</div>

<footer>
    <p>© 2024 Contenido de Estructuras de Datos. Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
