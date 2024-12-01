<?php
session_start();
include '../../db.php';

// Supongamos que el ID del usuario está almacenado en la sesión
if (!isset($_SESSION['IdUsuario'])) {
    echo "Error: Usuario no ha iniciado sesión.";
    exit();
}
$userId = $_SESSION['IdUsuario'];

// Consulta para obtener la ciudad del usuario
$sql = "SELECT Ciudad FROM usuarios WHERE idUsuario = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ciudadUsuario = $row['Ciudad'];
} else {
    echo "No se encontró la ciudad del usuario.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <link rel="stylesheet" href="../css/styles-clima.css">
    <link rel="stylesheet" href="../css/styles-inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#"><i class="fas fa-home"></i></a>
        </div>
        <div class="navbar-center">
            <a href="../templates/inicio.php">Inicio</a>
            <a href="../templates/descubre.php">Descubre</a>
            <a href="#">Sobre nosotros</a>
            <a href="../templates/juego.php">¡Ponte a prueba!</a>
            <a href="#">Recomendaciones</a>
            <a href="#">Contactanos</a>
            <a href="../templates/iniciarSesion.php">Iniciar sesión</a>
            <form action="cerrarSesion.php" method="post" style="display:inline;">
            <button type="submit" class="logout-btn">Cerrar Sesión</button>
        </form>
        </div>
        <div class="navbar-right">
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Búsqueda de ubicación">
            </div>
        </div>
    </nav>
    <div class="texto-izquierda">
        <h1 class="editable-text">GUARDIANES DEL CLIMA:</h1>
        <h2 class="editable-text">La Estrategia para Salvar Nuestro Futuro</h2>
    </div>
    
    <div class="weather-container">
        <div class="weather-app">
            <form class="search-form" method="post" action="">
                <input class="city-input" type="text" name="city" placeholder="Ingrese el nombre de la ciudad">
                <button class="search-btn" type="submit">
                    <i class="material-icons">search</i>
                </button>
            </form>
            <div class="city-date-section">
                <h2 class="city">Clima en <span id="city-name"><?php echo htmlspecialchars($ciudadUsuario); ?></span></h2>
                <p class="date"><?php echo date('d M Y'); ?></p>
            </div>
            <div class="temperature-info">
                <div class="description">
                    <i class="material-icons">sunny</i>
                    <span class="description-text">Soleado</span>
                </div>
                <div class="temp">30°C</div>
            </div>
            <div class="additional-info">
                <div class="wind-info">
                    <i class="material-icons">air</i>
                    <div>
                        <h3 class="wind-speed">6 KM/H</h3>
                        <p class="wind-label">Viento</p>
                    </div>
                </div>
                <div class="humidity-info">
                    <i class="material-icons">water_drop</i>
                    <div>
                        <h3 class="humidity">45%</h3>
                        <p class="humidity-label">Humedad</p>
                    </div>
                </div>
                <div class="visibility-info">
                    <i class="material-icons">visibility</i>
                    <div>
                        <h3 class="visibility-distance">2 KM</h3>
                        <p class="visibility-label">Visibilidad</p>
                    </div>
                </div>
                <div class="pressure-info">
                    <i class="material-icons">compare_arrows</i>
                    <div>
                        <h3 class="pressure">500 mb</h3>
                        <p class="pressure-label">Presión</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/scriptapi.js"></script>
</body>
</html>

