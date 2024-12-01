<?php
session_start();
include '../../db.php';

// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['password']);

    // Validar que los campos no estén vacíos
    if (empty($correo) || empty($contrasena)) {
        $errorMsg = "Por favor, complete todos los campos.";
    } else {
        // Consulta para verificar el usuario
        $stmt = $conn->prepare("SELECT IdUsuario FROM usuarios WHERE Correo = ? AND Contraseña = ?");
        $stmt->bind_param("ss", $correo, $contrasena);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['IdUsuario'] = $row['IdUsuario'];
            header("Location: inicio.php");
            exit();
        } else {
            $errorMsg = "Usuario o contraseña incorrectos.";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles-iniciarSesion.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if ($errorMsg): ?>
            <div class="error-message"><?php echo $errorMsg; ?></div>
        <?php endif; ?>
        <form action="iniciarSesion.php" method="post">
            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" required>
            
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="password" required>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
        <p class="registro">¿Aún no tienes cuenta? <a href="registrarse.php">Regístrate aquí :)</a></p>
    </div>
</body>
</html>
