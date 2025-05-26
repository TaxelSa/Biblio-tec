<?php
include 'conexion.php';

// Validar que se reciban todos los datos obligatorios
if (!isset($_POST['titulo'], $_POST['autor'], $_POST['editorial'], $_POST['area'])) {
    echo "Faltan datos obligatorios";
    exit;
}

// Limpiar y asignar variables
$titulo = trim($_POST['titulo']);
$autor = trim($_POST['autor']);
$editorial = trim($_POST['editorial']);
$area = trim($_POST['area']);

// Validar que no estén vacíos
if ($titulo === "" || $autor === "" || $editorial === "" || $area === "") {
    echo "Todos los campos son obligatorios";
    exit;
}

$sql = "INSERT INTO libros (titulo, autor, editorial, area) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error en la preparación: " . $conn->error;
    exit;
}

$stmt->bind_param("ssss", $titulo, $autor, $editorial, $area);

if ($stmt->execute()) {
    echo "Libro agregado correctamente";
} else {
    echo "Error al agregar libro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

