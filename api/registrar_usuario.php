<?php
include 'conexion.php';

$control = $_POST['num_control'];
$nombre = $_POST['nombre'];
$password = $_POST['contrasena'];
$tipo = strtolower($_POST['tipo'] ?? ''); // para convertir 'Alumno' a 'alumno'

$sql = "INSERT INTO usuarios (control, nombre, password, tipo) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $control, $nombre, $password, $tipo);

if ($stmt->execute()) {
    echo "Usuario registrado con éxito.";
} else {
    echo "Error al registrar usuario: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

