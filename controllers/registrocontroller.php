<?php
require_once '../conexion.php';
require_once '../models/usuario.php';

class registrocontroller {
    private $usuario;

    public function __construct($conexion) {
        $this->usuario = new usuario($conexion);
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recibir los datos del formulario
            $nombre = $_POST['nombre'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $contrasena = $_POST['contrasena'] ?? '';

            try {
                // Intentar registrar al usuario
                if ($this->usuario->registrar($nombre, $correo, $contrasena)) {
                    // Almacenar mensaje de éxito en la sesión
                    session_start();
                    $_SESSION['mensaje'] = "Registro exitoso!";
                    
                    // Redirigir a la página de índice
                    header("Location: ../views/usu_index.php");
                    exit();
                }
            } catch (Exception $e) {
                // Manejar errores y almacenar en la sesión
                session_start();
                $_SESSION['mensaje_error'] = $e->getMessage();
                
                // Redirigir de vuelta al formulario de registro
                header("Location: ../views/registro.php"); // Cambia a la ruta deseada para tu formulario de registro
                exit();
            }
        }
    }
}

// Instanciación y uso del controlador
try {
    $conexion = new PDO('mysql:host=localhost;dbname=estructuradatos', 'root', ''); // Ajusta la conexión a tu base de datos
    $registroController = new RegistroController($conexion);
    $registroController->registrar();
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
