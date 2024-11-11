<?php
// models/contenido.php
require_once '../conexion.php'; // Incluye la clase de conexión

class modelocontenido {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion; // La conexión se pasa al crear una instancia
    }

    // Método para obtener todos los contenidos
    public function obtenerContenidos() {
        $consulta = "SELECT id, titulo, descripcion, tipo, archivo FROM contenido";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->execute();
        
        // Fetch all results as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para agregar un nuevo contenido
    public function agregarContenido($titulo, $descripcion, $tipo, $archivo) {
        $consulta = "INSERT INTO contenido (titulo, descripcion, tipo, archivo) VALUES (:titulo, :descripcion, :tipo, :archivo)";
        $stmt = $this->conexion->prepare($consulta);
        return $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion,
            ':tipo' => $tipo,
            ':archivo' => $archivo
        ]);
    }

    // Método para eliminar un contenido
    public function eliminarContenido($id) {
        // Verificación opcional para asegurar que el contenido exista
        if (!$this->obtenerContenidoPorId($id)) {
            return false; // O lanza una excepción
        }

        $sql = "DELETE FROM contenido WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        
        try {
            return $stmt->execute([':id' => $id]);
        } catch (Exception $e) {
            // Manejo de excepciones
            error_log("Error al eliminar contenido: " . $e->getMessage());
            return false;
        }
    }

    // Método para obtener un contenido por ID
    public function obtenerContenidoPorId($id) {
        $sql = "SELECT id, titulo, descripcion, tipo, archivo FROM contenido WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna el contenido específico o null si no existe
    }

    // Método para actualizar un contenido
    public function actualizarContenido($id, $titulo, $descripcion, $tipo, $archivo) {
        $sql = "UPDATE contenido SET titulo = :titulo, descripcion = :descripcion, tipo = :tipo, archivo = :archivo WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        
        try {
            return $stmt->execute([
                ':titulo' => $titulo,
                ':descripcion' => $descripcion,
                ':tipo' => $tipo,
                ':archivo' => $archivo,
                ':id' => $id
            ]);
        } catch (Exception $e) {
            // Manejo de excepciones
            error_log("Error al actualizar contenido: " . $e->getMessage());
            return false;
        }
    }

    // Destructor para cerrar la conexión (opcional en PDO)
    public function __destruct() {
        $this->conexion = null; // Cierra la conexión al establecerla a null
    }
}
?>
