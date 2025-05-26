<?php
header('Content-Type: application/json');
include 'conexion.php';

$sql = "SELECT id, titulo, autor, editorial, area FROM libros";
$result = $conn->query($sql);

$librosPorArea = [
    "quimica" => [],
    "mecanica" => [],
    "sistemas" => [],
    "electrica" => []
];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $area = strtolower($row['area']);
        if (isset($librosPorArea[$area])) {
            $librosPorArea[$area][] = [
                'id' => $row['id'],
                'titulo' => $row['titulo'],
                'autor' => $row['autor'],
                'editorial' => $row['editorial']
            ];
        }
    }
}

echo json_encode($librosPorArea);

$conn->close();
?>
