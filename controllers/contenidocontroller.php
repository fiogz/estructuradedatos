<?php
// controllers/controlador_contenido.php
require_once '../conexion.php';
require_once '../models/contenido.php';

class controladorcontenido {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new ModeloContenido($conexion);
    }

    public function mostrarContenidos() {
        return $this->modelo->obtenerContenidos();
    }

    // En el método agregarContenido del controlador
public function agregarContenido($titulo, $descripcion, $tipo, $archivo) {
    if (empty($titulo) || empty($descripcion) || empty($tipo)) {
        return "Todos los campos son obligatorios.";
    }

    // Guardar el archivo en la carpeta 'documentos'
    $nombreArchivo = basename($archivo['name']);
    $rutaDestino = "../documentos/" . $nombreArchivo;
    
    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        // Solo el nombre del archivo se guarda en la base de datos
        if ($this->modelo->agregarContenido($titulo, $descripcion, $tipo, $nombreArchivo)) {
            return "Contenido agregado exitosamente.";
        } else {
            return "Error al agregar contenido.";
        }
    } else {
        return "Error al subir la imagen.";
    }
}


    public function eliminarContenido($id) {
        if ($this->modelo->eliminarContenido($id)) {
            return "Contenido eliminado exitosamente.";
        } else {
            return "Error al eliminar contenido.";
        }
    }

    public function editarContenido($id) {
        return $this->modelo->obtenerContenidoPorId($id);
    }

    public function actualizarContenido($id, $titulo, $descripcion, $tipo, $archivo) {
        if (empty($titulo) || empty($descripcion) || empty($tipo)) {
            return "Todos los campos son obligatorios.";
        }

        if ($this->modelo->actualizarContenido($id, $titulo, $descripcion, $tipo, $archivo)) {
            return "Contenido actualizado exitosamente.";
        } else {
            return "Error al actualizar contenido.";
        }
    }
}
?>
