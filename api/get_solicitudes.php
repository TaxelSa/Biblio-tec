<?php
// ../api/get_solicitudes.php

header('Content-Type: text/html; charset=utf-8');

$host = "localhost";
$db = "Bibliotec";
$user = "root";
$pass = "";


$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo "<tr><td colspan='7'>Error de conexión a la base de datos.</td></tr>";
    exit;
}

// Consulta para obtener todas las solicitudes
$sql = "SELECT id, numero_control, nombre_libro, autor, editorial, fecha_solicitud 
        FROM carritos ORDER BY fecha_solicitud DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['numero_control']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nombre_libro']) . "</td>";
        echo "<td>" . htmlspecialchars($row['autor']) . "</td>";
        echo "<td>" . htmlspecialchars($row['editorial']) . "</td>";
        echo "<td>" . htmlspecialchars($row['fecha_solicitud']) . "</td>";
        echo "<td>
                <button onclick='aprobarSolicitud(" . $row['id'] . ")'>Aprobar</button>
                <button onclick='rechazarSolicitud(" . $row['id'] . ")'>Rechazar</button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No hay solicitudes pendientes.</td></tr>";
}

$conn->close();
?>