<?php
session_start();
include '../../db.php';

// Obtener la ciudad del usuario activo
if (isset($_SESSION['IdUsuario'])) {
    $userId = $_SESSION['IdUsuario'];
    $sql = "SELECT Ciudad FROM usuarios WHERE idUsuario = $userId";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $ciudadUsuario = $row['Ciudad'];
} else {
    $ciudadUsuario = 'Madrid';
}

// Al inicio del archivo, antes del HTML
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si hay datos recibidos
    $jsonData = file_get_contents('php://input');
    if (empty($jsonData)) {
        die('No se recibieron datos del clima');
    }

    // Decodificar JSON con verificación
    $weatherData = json_decode($jsonData, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Error al decodificar JSON: ' . json_last_error_msg());
    }

    // Verificar que todos los datos necesarios estén presentes
    if (!isset($weatherData['temperatura']) || 
        !isset($weatherData['viento']) || 
        !isset($weatherData['humedad']) || 
        !isset($weatherData['visibilidad']) || 
        !isset($weatherData['presion'])) {
        die('Faltan datos del clima necesarios');
    }

    $prompt = sprintf(
        "Según las condiciones climaticas, recomienda actividades y advierte de posibles catastrofes (si existe la posibilidad manten la respuesta clara y concisa): temperatura: %d viento: %.2f km/h humedad: %d%% visibilidad: %dkm presión: %dmb (responde en español)",
        $weatherData['temperatura'],
        $weatherData['viento'],
        $weatherData['humedad'],
        $weatherData['visibilidad'],
        $weatherData['presion']
    );

    // Usar curl para hacer la petición al servidor Flask
    $ch = curl_init('http://localhost:5000/chat');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['prompt' => $prompt]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    error_log("Prompt enviado a Llama3: " . $prompt);
    
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        error_log('Error Curl: ' . curl_error($ch));
        echo "Error al conectar con el servidor de Llama3";
    } else {
        $decoded_response = json_decode($response, true);
        error_log("Respuesta completa de Llama3: " . print_r($decoded_response, true));
        echo $decoded_response['respuesta'];
    }
    
    curl_close($ch);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <!--<link rel="stylesheet" href="../css/styles-clima.css">-->
    <!--<link rel="stylesheet" href="../css/styles-inicio.css">-->
    <link rel="stylesheet" href="../css/descubre.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

    <nav class="navbar">
        <div class="navbar-left">
            <a href="#"><i class="fas fa-home"></i></a>
        </div>
        <div class="navbar-center">
            <a href="../templates/inicio.php">Inicio</a>
            <a href="../templates/descubre.php">Descubre</a>
            <a href="../templates/inicio.php">Sobre nosotros</a>
            <a href="../templates/juego.php">¡Ponte a prueba!</a>
            <a href="../templates/blog.php">Recomendaciones</a>
            <a href="../templates/inicio.php">Contactanos</a>
            <form action="cerrarSesion.php" method="post" style="display:inline;">
                <button type="submit" class="logout-btn">Cerrar Sesión</button>
            </form>
        </div>
    </nav>
    
    <div class="weather-app">
        <div>
        <form class="search-form" action="">
            <input class="city-input" type="text" placeholder="Enter City Name" />
            <button class="search-btn" type="submit">
                <i class="material-icons">search</i>
            </button>
        </form>
        <div class="city-date-section">
            <h2 class="city">¡Descubre el clima en tu ciudad!🍃</h2>
            <p class="date">‍ ‍ ‍ ‍ ‍</p>
        </div>
        <div class="temperature-info">
            <div class="description">
                <i class="material-icons">sunny</i>
                <span class="description-text">‍ ‍ ‍ ‍ ‍</span>
            </div>
            <div class="temp">‍ ‍ ‍ ‍ ‍</div>
        </div>
        <div class="additional-info">
            <div class="wind-info">
                <i class="material-icons">air</i>
                <div>
                    <h3 class="wind-speed">‍ ‍ ‍ ‍ ‍</h3>
                    <p class="wind-label">Wind</p>
                </div>
            </div>
            <div class="humidity-info">
                <i class="material-icons">water_drop</i>
                <div>
                    <h3 class="humidity">‍ ‍ ‍ ‍ ‍</h3>
                    <p class="humidity-label">humidity</p>
                </div>
            </div>
            <div class="visibility-info">
                <i class="material-icons">visibility</i>
                <div>
                    <h3 class="visibility-distance">‍ ‍ ‍ ‍ ‍</h3>
                    <p class="visibility">Visibility</p>
                </div>
            </div>
            <div class="pressure-info">
                <i class="material-icons">compare_arrows</i>
                <div>
                    <h3 class="pressure">‍ ‍ ‍ ‍ ‍</h3>
                    <p class="pressure-label">Pressure</p>
                </div>
            </div>
        </div>
        </div>
        
        <div class="recomendaciones-panel">
            <h2>Recomendaciones</h2>
            <p class="Recomendaciones">Busca una ciudad para obtener recomendaciones basadas en el clima.</p>
        </div>
    </div>
<script src="../js/scriptapi.js" data-ciudad="<?php echo $ciudadUsuario; ?>"></script>
</body>

</html>