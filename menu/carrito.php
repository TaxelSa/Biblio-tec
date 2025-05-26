<?php
session_start();
include '../api/conexion.php';

// Reemplaza con la sesión real cuando esté lista
$numero_control = $_SESSION['control'] ?? '20240001';


// Consultar los libros solicitados por el usuario
$sql = "SELECT id, nombre_libro, autor, editorial FROM carritos WHERE numero_control = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $numero_control);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Carrito - BiblioTEC</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #003366;
        }
        .carrito-container {
            max-width: 800px;
            margin: auto;
        }
        .book-card {
            background: white;
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .book-card strong {
            font-size: 18px;
            color: #333;
        }
        .book-card small {
            color: #666;
        }
        .remove-btn {
            margin-top: 10px;
            background: #d9534f;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
        }
        .remove-btn:hover {
            background: #c9302c;
        }
        .no-items {
            text-align: center;
            color: #888;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h1>Mi Carrito de Libros</h1>
    <div class="carrito-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="book-card">
                    <strong><?= htmlspecialchars($row['nombre_libro']) ?></strong><br>
                    <small>Autor: <?= htmlspecialchars($row['autor']) ?></small><br>
                    <small>Editorial: <?= htmlspecialchars($row['editorial']) ?></small><br>
                    <form method="POST" action="../api/eliminar_libro.php">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" class="remove-btn">Eliminar</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-items">No tienes libros en tu carrito.</p>
        <?php endif; ?>
    </div>

</body>
</html>
<?php $conn->close(); ?>
