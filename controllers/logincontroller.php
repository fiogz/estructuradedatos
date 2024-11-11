<?php
session_start();
require_once '../conexion.php';
require_once '../models/usuario.php';

class logincontroller {
    private $usuario;

    public function __construct($conexion) {
        $this->usuario = new usuario($conexion);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los datos del formulario
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];

            try {
                // Intentar iniciar sesión
                $resultado = $this->usuario->login($correo, $contrasena);

                // Almacenar los datos del usuario en la sesión
                $_SESSION['id'] = $resultado['id'];
                $_SESSION['nombre'] = $resultado['nombre'];
                $_SESSION['rol'] = $resultado['rol'];

                // Redirigir según el rol
                if ($resultado['rol'] === 'administrador') {
                    header("Location: ../views/admin_index.php");
                } else {
                    header("Location: ../views/usu_index.php");
                }
                exit;
            } catch (Exception $e) {
                // Mostrar error en caso de que falle el inicio de sesión
                echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
            }
        }
    }
}

// Crear una instancia del controlador y llamar al método de inicio de sesión
try {
    $conexion = new PDO('mysql:host=localhost;dbname=estructuradatos', 'root', ''); // Cambia estos valores según tu configuración
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Manejo de excepciones en PDO
    $loginController = new LoginController($conexion);
    $loginController->login();
} catch (PDOException $e) {
    // Manejo de errores de conexión
    echo "<div class='alert alert-danger'>Error de conexión: " . $e->getMessage() . "</div>";
}
?>
