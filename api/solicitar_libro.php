<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['control'])) {
    echo "Error: No has iniciado sesión.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreLibro = $_POST['nombre_libro'];
    $numeroControl = $_SESSION['control']; // ← Usamos la sesión real

    // Obtener detalles del libro
    $stmt = $conn->prepare("SELECT autor, editorial FROM librosA WHERE nombre = ?");
    $stmt->bind_param("s", $nombreLibro);
    $stmt->execute();
    $result = $stmt->get_result();
    $libro = $result->fetch_assoc();

    if ($libro) {
        $autor = $libro['autor'];
        $editorial = $libro['editorial'];
        $fecha = date('Y-m-d');

        $stmt = $conn->prepare("INSERT INTO carritos (numero_control, nombre_libro, autor, editorial, fecha_solicitud) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $numeroControl, $nombreLibro, $autor, $editorial, $fecha);
        $stmt->execute();

        echo "Solicitud registrada correctamente.";
    } else {
        echo "Libro no encontrado.";
    }
}
?>

