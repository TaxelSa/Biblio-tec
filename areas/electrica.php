<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "Bibliotec";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT nombre, autor, editorial FROM librosA WHERE area = 'Electrica'";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Libros Ingeniería Eléctrica - BiblioTEC</title>
    <link rel="stylesheet" href="estilos.css" />
    <style>
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .book {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            background: #f9f9f9;
        }
        .book img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .btn-regresar {
            margin: 20px 0;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <ul class="menu">
            <li><a href="../areas/quimica.php">Química</a></li>
            <li><a href="../areas/sistemas.php">Sistemas</a></li>
            <li><a href="../areas/mecanica.php">Mecánica</a></li>
            <li><a href="../areas/electrica.php" class="activo">Eléctrica</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <button onclick="location.href='../menu/menu.php'" class="btn-regresar">Regresar</button>
    <h2>Ingeniería Eléctrica</h2>
    <div class="books-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombre = htmlspecialchars($row['nombre']);
                $autor = htmlspecialchars($row['autor']);
                $editorial = htmlspecialchars($row['editorial']);

                // Convertir nombre del libro a nombre de archivo para la imagen
                $fileName = strtolower(str_replace(" ", "-", $nombre)) . ".jpeg";
                $imgPath = "../assets/$fileName";
                if (!file_exists($imgPath)) {
                    $imgPath = "../assets/placeholder.jpg"; // Imagen por defecto
                }

                echo "<div class='book'>
                        <img src='$imgPath' alt='$nombre' />
                        <p><strong>$nombre</strong></p>
                        <p><small>Autor: $autor</small></p>
                        <p><small>Editorial: $editorial</small></p>
                        <form method='POST' class='solicitar-libro'>
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

<script>
// Enviar solicitud sin recargar la página
document.querySelectorAll("form.solicitar-libro").forEach(form => {
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        const data = new FormData(form);
        fetch("../api/solicitar_libro.php", {
            method: "POST",
            body: data
        })
        .then(res => res.text())
        .then(msg => alert(msg))
        .catch(err => alert("Error al solicitar libro"));
    });
});
</script>
</body>
</html>

