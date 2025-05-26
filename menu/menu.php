<?php
include '../api/conexion.php';

$sql = "SELECT area, titulo, autor, editorial FROM libros ORDER BY id DESC LIMIT 20";
$result = $conn->query($sql);

$libros_por_area = [
  'quimica' => [],
  'sistemas' => [],
  'mecanica' => [],
  'electrica' => []
];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $area = strtolower($row['area']);
    if (isset($libros_por_area[$area])) {
      $libros_por_area[$area][] = $row;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Menú - Biblioteca Tec Orizaba</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0; padding: 0;
    }
    header {
      background-color: #002f6c;
      color: white;
      padding: 20px;
      text-align: center;
      position: relative;
    }
    .logout {
      position: absolute;
      right: 20px; top: 20px;
      background: white;
      color: red;
      border: 2px solid red;
      padding: 10px;
      font-weight: bold;
      border-radius: 5px;
      text-decoration: none;
    }
    .logout:hover {
      background-color: #ff4d4d;
      color: white;
    }
    .cart-btn {
      position: absolute;
      left: 20px; top: 20px;
      background: white;
      color: #002f6c;
      border: 2px solid #002f6c;
      padding: 10px;
      font-weight: bold;
      border-radius: 5px;
      text-decoration: none;
    }
    .cart-btn:hover {
      background-color: #00509e;
      color: white;
    }
    nav {
      background-color: #002f6c;
      padding: 10px;
      display: flex;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }
    nav a {
      background-color: white;
      color: #002f6c;
      padding: 12px 20px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: bold;
      border: 2px solid #002f6c;
      transition: all 0.3s ease;
    }
    nav a:hover {
      background-color: #00509e;
      color: white;
      transform: scale(1.05);
    }
    .main-content {
      margin: 30px auto;
      width: 90%;
    }
    .area-section {
      background-color: white;
      border: 2px solid #002f6c;
      border-radius: 10px;
      padding: 15px 20px;
      margin-bottom: 30px;
    }
    .area-section h2 {
      color: #002f6c;
      margin-bottom: 15px;
      border-bottom: 2px solid #002f6c;
      padding-bottom: 5px;
    }
    .books-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill,minmax(220px,1fr));
      gap: 15px;
    }
    .book-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.15);
      padding: 15px 20px;
      transition: transform 0.2s ease;
      cursor: default;
    }
    .book-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.25);
    }
    .book-title {
      font-weight: bold;
      font-size: 1.1em;
      color: #002f6c;
      margin-bottom: 8px;
    }
    .book-details {
      color: #555;
      font-style: italic;
      font-size: 0.9em;
    }
    footer {
      background-color: #002f6c;
      color: white;
      text-align: center;
      padding: 10px;
      position: fixed;
      width: 100%;
      bottom: 0;
    }
  </style>
</head>
<body>

<header>
  <h1>Biblio-Tec</h1>
</header>
<nav>
  <a href="../areas/quimica.php">Química</a>
  <a href="../areas/sistemas.php">Sistemas</a>
  <a href="../areas/mecanica.php">Mecánica</a>
  <a href="../areas/electrica.php">Eléctrica</a>
  <a href="../menu/carrito.php" class="cart-btn">Mi Carrito</a>
  <a href="../login/login.html" class="logout">Cerrar Sesión</a>
</nav>

<div class="main-content">

  <?php foreach ($libros_por_area as $area => $libros): ?>
  <section class="area-section">
    <h2><?= ucfirst($area) ?></h2>
    <?php if (count($libros) > 0): ?>
      <div class="books-grid">
      <?php foreach ($libros as $libro): ?>
        <div class="book-card">
          <div class="book-title"><?= htmlspecialchars($libro['titulo']) ?></div>
          <div class="book-details">Autor: <?= htmlspecialchars($libro['autor']) ?></div>
          <div class="book-details">Editorial: <?= htmlspecialchars($libro['editorial']) ?></div>
        </div>
      <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p>No hay libros disponibles en esta área.</p>
    <?php endif; ?>
  </section>
  <?php endforeach; ?>

</div>

<footer>
  <p>&copy; 2025 Instituto Tecnológico de Orizaba</p>
</footer>

</body>
</html>

<?php $conn->close(); ?>
