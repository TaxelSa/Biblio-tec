<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "Bibliotec";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT nombre, autor, editorial, img FROM librosA WHERE area = 'Mecanica'";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Libros Ingeniería Mecánica - BiblioTEC</title>
    <link rel="stylesheet" href="estilos.css" />
</head>
<body>
<header>
    <nav>
        <ul class="menu">
            <li><a href="../areas/quimica.php">Química</a></li>
            <li><a href="../areas/sistemas.php">Sistemas</a></li>
            <li><a href="../areas/mecanica.php" class="activo">Mecanica</a></li>
            <li><a href="../areas/electrica.php">Eléctrica</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <button onclick="location.href='../menu/menu.php'" class="btn-regresar">Regresar</button>
    <h2>Ingeniería Industrial</h2>
    <div class="books-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imgSrc = !empty($row['img']) ? "../img/" . basename(htmlspecialchars($row['img'])) : "../img/libro_placeholder.jpg";
                $altText = htmlspecialchars($row['nombre']);
                $nombre = htmlspecialchars($row['nombre']);
                $autor = htmlspecialchars($row['autor']);
                $editorial = htmlspecialchars($row['editorial']);
                echo "<div class='book' style='text-align: center;'>
                        <img src='$imgSrc' alt='$altText' class='book-image' style='max-width: 200px; height: auto;'>
                        <p>$nombre</p>
                        <p><small>Autor: $autor</small></p>
                        <p><small>Editorial: $editorial</small></p>
                        <form method='POST' action='solicitar_libro.php'>
                            <input type='hidden' name='nombre_libro' value='$nombre' />
                            <button type='submit'>Solicitar</button>
                        </form>
                      </div>";
            }
        } else {
            echo "<p>No hay libros disponibles en esta área.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

<footer>
    BiblioTEC &copy; 2025
</footer>
</body>
</html>
