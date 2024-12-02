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
$row = $result->fetch_assoc();
$ciudadUsuario = $row['Ciudad'];

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
    </nav>

    <div class="main-content">
        <div class="texto-izquierda">
            <h1 class="editable-text">GUARDIANES DEL CLIMA:</h1>
            <h2 class="editable-text">La Estrategia para Salvar Nuestro Futuro</h2>
            
            <!-- Nueva sección para recomendaciones de IA -->
            <div class="ai-recommendations-container">
                <!-- Las recomendaciones de IA se insertarán aquí mediante JavaScript -->
            </div>
        </div>

        <div class="weather-container">
            <div class="weather-app">
                <div class="city-date-section">
                    <h2 class="city">Clima en <span id="city-name"></span></h2>
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
    </div>

    <style>
        .main-content {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .texto-izquierda {
            flex: 1;
            padding-right: 40px;
        }

        .weather-container {
            flex: 1;
        }

        .ai-recommendations-container {
            margin-top: 30px;
        }

        .ai-recommendations {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .ai-recommendations h3 {
            color: #333;
            margin-bottom: 15px;
            font-family: 'Noto Serif Display', serif;
            font-size: 1.2em;
        }

        .ai-recommendations p {
            line-height: 1.6;
            color: #444;
            font-size: 1em;
        }

        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .texto-izquierda {
                padding-right: 0;
                margin-bottom: 30px;
            }
        }
    </style>
    <script src="../js/scriptlocal.js" data-ciudad="<?php echo $ciudadUsuario; ?>"></script>
</body>
</html>

