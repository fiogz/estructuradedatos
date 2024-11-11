<?php
session_start();

// Incluir el archivo de conexión a la base de datos
require_once '../conexion.php';
require_once '../models/usuario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    try {
        // Crear una instancia del modelo de usuario
        $usuarioModelo = new usuario($conexion);

        // Intentar iniciar sesión
        $usuario = $usuarioModelo->login($correo, $contrasena);

        if ($usuario) {
            // Almacenar datos del usuario en la sesión
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre']; // Asegúrate de que esto esté en la tabla de usuarios
            $_SESSION['rol'] = $usuario['rol'];

            // Redirigir según el rol
            if ($usuario['rol'] === 'administrador') {
                header("Location: ./admin_index.php");
            } else if ($usuario['rol'] === 'usuario') {
                header("Location: ./usu_index.php");
            } else {
                echo "<div class='alert alert-danger'>Rol no reconocido.</div>";
            }
            exit;
        } else {
            echo "<div class='alert alert-danger'>Correo o contraseña incorrectos.</div>";
        }

    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../images/fondo.jpg'); 
            background-color: #343a40; /* Color de fondo oscuro */
            color: #ffffff;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Color de texto claro */
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro con opacidad */
        }
        .container {
            margin-top: 100px; /* Aumentar el margen superior */
            flex: 1; /* Para ocupar el espacio restante */
            max-width: 600px; /* Aumentar el ancho máximo de la tarjeta */
        }
        .card {
            border: 1px solid dark;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            background-color: #343a40;
        }

        .form-label {
            color: #ffffff; /* Color de las etiquetas */
        }
    
        .card-header {
            background-color: #1d5461;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            color: #ffffff;
        }

        .btn {
            background-color: #acb295;
            color: #212529;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 5px;
        }

        .btn:hover {
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
<div class="overlay"></div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h4>Iniciar Sesión</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" name="correo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" name="contrasena" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Iniciar sesión</button>
                            <a href="registro.php" class="btn btn-secondary">Registrarse</a>
                            <a href="../index.php" class="btn btn-secondary">Volver al inicio</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
