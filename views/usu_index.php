<?php
session_start(); // Inicia la sesión

// Verifica si hay un mensaje y lo almacena en una variable
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']); // Elimina el mensaje después de mostrarlo
?>
<?php
require_once '../conexion.php';
require_once '../controllers/contenidoController.php';

// Crea una instancia del controlador
$controlador = new controladorcontenido($conexion);
$contenidos = $controlador->mostrarContenidos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido de Estructuras de Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url("../images/fondo.jpg");
            color: #1d5461;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: Arial, sans-serif;
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
    <h1>Estructuras de Datos</h1>
</div>
<div class="container text-start mt-4">
    <a href="../views/perfilusuario.php" class="btn btn-custom">Cerrar Sesión</a>
</div>
<div class="container mt-4">
    <?php if ($mensaje): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <div class="content">
        <h2 class="text-center">Temas Disponibles</h2>
        <div class="accordion" id="accordionExample">
        <?php if ($contenidos && count($contenidos) > 0): ?>
            <?php foreach ($contenidos as $index => $contenido): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                        <button class="accordion-button <?php echo $index !== 0 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $index; ?>">
                            <?php echo htmlspecialchars($contenido['titulo']); ?>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p><?php echo htmlspecialchars($contenido['descripcion']); ?></p>
                            <a href="detallecontenido_user.php?id=<?php echo $contenido['id']; ?>" class="btn btn-custom">Ver Más</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading0">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse0" aria-expanded="true" aria-controls="collapse0">
                        No hay contenidos disponibles
                    </button>
                </h2>
                <div id="collapse0" class="accordion-collapse collapse show" aria-labelledby="heading0" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>No hay contenidos disponibles en este momento.</p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    </div>
</div>
<footer>
    <p>© 2024 Contenido de Estructuras de Datos. Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
