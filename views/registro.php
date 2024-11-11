<?php
session_start(); // Inicia la sesión

// Verifica si hay mensajes de error o éxito y los almacena en variables
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
$mensaje_error = isset($_SESSION['mensaje_error']) ? $_SESSION['mensaje_error'] : '';

// Elimina los mensajes de la sesión después de mostrarlos
unset($_SESSION['mensaje']);
unset($_SESSION['mensaje_error']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
    <div class="card">
        <div class="card-header">
            <h2>Registro</h2>
        </div>
        <div class="card-body">

            <?php if ($mensaje): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>

            <?php if ($mensaje_error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($mensaje_error); ?>
                </div>
            <?php endif; ?>

            <form action="../controllers/registrocontroller.php" method="POST"><!-- Cambia la ruta según corresponda -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
                           <a href="login.php" class="btn btn-secondary">Iniciar Sesión</a>
     <a href="../index.php" class="btn btn-secondary">Volver al inicio</a>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 