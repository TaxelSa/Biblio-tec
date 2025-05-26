<?php
session_start();
header('Content-Type: application/json');

// Verifica si el usuario ha iniciado sesión y es alumno o profesor
if (!isset($_SESSION['control']) || !in_array($_SESSION['rol'], ['alumno', 'profesor'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'No autorizado']);
    exit;
}

// Asegura que se está usando el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id'])) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'ID no proporcionado']);
        exit;
    }

    $id = intval($_POST['id']);  // Sanitiza el ID

    $conn = new mysqli("localhost", "root", "", "bibliotec");

    if ($conn->connect_error) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error de conexión']);
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM solicitudes WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Solicitud eliminada']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar']);
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
