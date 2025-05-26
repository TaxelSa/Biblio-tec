<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Preparar la consulta para eliminar el libro por id
        $stmt = $conn->prepare("DELETE FROM carritos WHERE id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            // Redirigir a carrito.php después de eliminar para refrescar la lista
            header("Location: ../menu/carrito.php");
            exit();
        } else {
            echo "Error al eliminar el libro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ID no proporcionado.";
    }
} else {
    echo "Método no permitido.";
}

$conn->close();
?>

