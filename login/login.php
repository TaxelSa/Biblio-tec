<?php
session_start(); // Iniciar sesión

// Datos de conexión a la base
$host = "localhost";
$user = "root";
$pass = "";
$db = "bibliotec";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos enviados por POST
$control = $_POST['control'] ?? '';
$password = $_POST['password'] ?? '';
$rol = $_POST['rol'] ?? '';

// Validar campos obligatorios
if (empty($control) || empty($password) || empty($rol)) {
    header("Location: login_form.php?error=Faltan campos obligatorios");
    exit();
}

// Preparar consulta para buscar usuario
$stmt = $conn->prepare("SELECT password, tipo FROM usuarios WHERE control = ?");
$stmt->bind_param("s", $control);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Verificar contraseña (comparación directa, considera usar hash en producción)
    if ($password === $row['password']) {
        // Verificar que el rol coincide
        if ($rol === $row['tipo']) {
            // Guardar variables de sesión necesarias
            $_SESSION['usuario_id'] = $control; // Esta es la que espera tu carrito
            $_SESSION['control'] = $control;
            $_SESSION['rol'] = $rol;

            // Redirigir según el rol
            if ($rol === 'administrador') {
                header("Location: ../admin/admin.html");
            } else {
                header("Location: ../menu/menu.php");
            }
            exit();
        } else {
            header("Location: login_form.php?error=El tipo de usuario no coincide");
            exit();
        }
    } else {
        header("Location: login_form.php?error=Contraseña incorrecta");
        exit();
    }
} else {
    header("Location: login_form.php?error=Número de control no encontrado");
    exit();
}
?>
