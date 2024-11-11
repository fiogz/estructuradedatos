<?php 
$servidor = "localhost"; // o la dirección de tu servidor de base de datos
$usuario = "root"; // tu nombre de usuario de MySQL
$contrasena = ""; // tu contraseña de MySQL (vacía en tu caso)
$basededatos = "estructuradatos"; // el nombre de tu base de datos

try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$basededatos", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>
