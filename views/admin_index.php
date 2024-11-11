<?php
require_once '../conexion.php';
require_once '../controllers/contenidocontroller.php';

// Crea una instancia del controlador
$controlador = new controladorcontenido($conexion);
$contenidos = $controlador->mostrarContenidos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Contenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #dbeadd;
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
    <h1>Panel de Administración - Contenido de Estructuras de Datos</h1>
</div>

<div class="container text-center mt-4">
    <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#agregarContenidoModal">
        Agregar Nuevo Contenido
    </button>
    <a href="../views/ver_contenido.php" class="btn btn-custom">Contenidos</a>
    <a href="../views/lista_usu.php" class="btn btn-custom">Usuarios</a>
    <a href="../views/perfilusuario.php" class="btn btn-custom">Cerrar Sesión</a>
</div>

<div class="content">
    <h2 class="text-center">Temas</h2>
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
                        <a href="detallecontenido.php?id=<?php echo $contenido['id']; ?>" class="btn btn-custom">Ver Más</a>
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

<!-- Modal para agregar contenido -->
<div class="modal fade" id="agregarContenidoModal" aria-labelledby="agregarContenidoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarContenidoModalLabel">Agregar Nuevo Contenido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí se incluye el formulario desde agregar_con.php -->
                <?php include 'agregar_con.php'; ?>
            </div>
        </div>
    </div>
</div>
 
<footer>
    <p>© 2024 Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Script para recargar la página tras agregar contenido -->
<script>
document.getElementById('formAgregarContenido').addEventListener('submit', function(event) {
    // Espera un momento después de enviar el formulario para recargar
    setTimeout(function() {
        // Redirige a la misma página con un parámetro único para evitar caché
        location.href = 'index.php?' + new Date().getTime();
    }, 100); // Tiempo en milisegundos
});
</script>

</body>
</html>
