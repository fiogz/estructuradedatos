
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/fondo.jpg'); /* Cambia esto por la URL de tu imagen */
            background-size: cover; /* Asegúrate de que la imagen cubra toda la pantalla */
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column; /* Cambiado para permitir el footer en la parte baja */
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
            flex: 1; /* Para ocupar el espacio restante */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            position: relative;
            width: 100%;
            max-width: 100%;
            max-height: 90%; /* Tamaño de la tarjeta */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border-radius: 15px; /* Bordes redondeados */
            z-index: 1; /* Asegúrate de que la tarjeta esté encima del overlay */
        }
        .card-body {
            padding: 2rem; /* Espaciado interno */
            text-align: center; /* Centrar el texto */
        }
        .card-title {
            color: #f8f9fa; /* Título claro */
            font-size: 1.75rem; /* Tamaño de fuente más grande */
            margin-bottom: 1rem; /* Espacio debajo del título */
            font-weight: bold; /* Negrita */
        }
        .card-text {
            color: #dcdcdc; /* Color del texto */
            margin-bottom: 2rem; /* Espacio debajo del texto */
        }
        .btn-primary {
            background-color: #0d6efd; /* Botón primario */
            border-color: #0d6efd; /* Borde del botón primario */
            padding: 10px 20px; /* Espaciado interno del botón */
            border-radius: 5px; /* Bordes redondeados en el botón */
            transition: background-color 0.3s; /* Efecto de transición */
        }
        .btn-secondary {
            background-color: #6c757d; /* Botón secundario */
            border-color: #6c757d; /* Borde del botón secundario */
            padding: 10px 20px; /* Espaciado interno del botón */
            border-radius: 5px; /* Bordes redondeados en el botón */
            transition: background-color 0.3s; /* Efecto de transición */
        }
        .btn:hover {
            opacity: 0.8; /* Efecto al pasar el ratón */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Color al pasar el ratón */
            border-color: #0056b3; /* Borde al pasar el ratón */
        }
        .btn-secondary:hover {
            background-color: #5a6268; /* Color al pasar el ratón */
            border-color: #545b62; /* Borde al pasar el ratón */
        }
        footer {
            background-color: #212529; /* Color de fondo del footer */
            color: #ffffff; /* Color del texto del footer */
            text-align: center;
            padding: 1rem;
            position: relative;
            bottom: 0;
            width: 100%;
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
   
    </style>
</head>
<body>
    <div class="overlay"></div> <!-- Capa oscura -->
    <div class="container">
        <div class="card mt-5 bg-dark">
            <div class="card-body">
                <h5 class="card-title">Sistema Web para la Gestión de Contenido Educativo</h5>
                <p class="card-text">Inicie sesión para acceder a su cuenta o regístrese si aún no tiene una.</p>
                <a href="views/login.php" class="btn btn-primary btn-lg">Iniciar sesión</a>
                <a href="views/registro.php" class="btn btn-secondary btn-lg">Registrarse</a>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Todos los derechos reservados.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
