<?php
require_once '../conexion.php'; // Asegúrate de que este archivo esté en la misma carpeta o ajusta la ruta

class usuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function verificarCorreo($correo) {
        $stmt = $this->conexion->prepare("SELECT id FROM usuarios WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->rowCount() > 0; // Devuelve true si el correo ya existe
    }

    public function registrar($nombre, $correo, $contrasena) {
        // Validar datos
        if (empty($nombre) || empty($correo) || empty($contrasena)) {
            throw new Exception("Todos los campos son obligatorios.");
        }

        // Verificar si el correo ya está en uso
        if ($this->verificarCorreo($correo)) {
            throw new Exception("El correo ya está en uso.");
        }

        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $rol = 'usuario'; // Rol por defecto

        $stmt = $this->conexion->prepare("INSERT INTO usuarios (nombre, correo, contrasena, rol) VALUES (:nombre, :correo, :contrasena, :rol)");

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena_hash);
        $stmt->bindParam(':rol', $rol);

        if ($stmt->execute()) {
            return true; // Registro exitoso
        } else {
            throw new Exception("Error al ejecutar la consulta: " . implode(", ", $stmt->errorInfo()));
        }
    }

    public function login($correo, $contrasena) {
        // Definir la contraseña del administrador
        $adminCorreo = 'admin@gmail.com'; // Cambia esto al correo del administrador
        $adminContrasena = '12345'; // Cambia esto a la contraseña que desees

        // Verificar si el correo es el del administrador
        if ($correo === $adminCorreo && $contrasena === $adminContrasena) {
            return [
                'id' => 9, // ID ficticio para el administrador
                'nombre' => 'administrador', // Nombre ficticio
                'rol' => 'administrador'
            ];
        }

        // Preparar la consulta para obtener el usuario
        $query = "SELECT id, rol, contrasena FROM usuarios WHERE correo = :correo LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        // Verificar si se encontró el usuario
        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar la contraseña hasheada
            if (password_verify($contrasena, $usuario['contrasena'])) {
                return $usuario; // Devuelve los datos del usuario si es correcto
            } else {
                // Contraseña incorrecta
                throw new Exception("La contraseña es incorrecta.");
            }
        } else {
            // No se encontró el usuario
            throw new Exception("El correo no está registrado.");
        }

        return false; // Si no se encuentra o la contraseña es incorrecta, retornar false
    }
}
?>
