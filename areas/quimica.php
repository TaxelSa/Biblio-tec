<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "Bibliotec";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT nombre, autor, editorial FROM librosA WHERE area = 'Quimica'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Libros Ingeniería Química</title>
    <link rel="stylesheet" href="estilos.css" />
    <style>
        .books-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; margin-top: 20px; }
        .book { border: 1px solid #ccc; padding: 10px; border-radius: 8px; text-align: center; background: #f9f9f9; }
        .book img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>
<header>
    <nav>
        <ul class="menu">
            <li><a href="../areas/quimica.php" class="activo">Química</a></li>
            <li><a href="../areas/sistemas.php">Sistemas</a></li>
            <li><a href="../areas/mecanica.php">Mecánica</a></li>
            <li><a href="../areas/electrica.php">Eléctrica</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <button onclick="location.href='../menu/menu.php'">Regresar</button>
    <h2>Ingeniería Química</h2>
    <div class="books-grid">
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombre = htmlspecialchars($row['nombre']);
                $autor = htmlspecialchars($row['autor']);
                $editorial = htmlspecialchars($row['editorial']);
                $fileName = strtolower(str_replace(" ", "-", $nombre)) . ".jpeg";
                $imgPath = "../assets/$fileName";
                if (!file_exists($imgPath)) $imgPath = "../assets/placeholder.jpg";

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
            echo "<p>No hay libros en esta área.</p>";
        }
        $conn->close();
        ?>
    </div>
</div>

<script>
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
        .catch(() => alert("Error al solicitar libro."));
    });
});
</script>
</body>
</html>

