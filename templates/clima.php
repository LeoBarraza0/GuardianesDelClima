<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles-clima.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Clima</title>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#"><i class="material-icons">home</i></a>
        </div>
        <div class="navbar-center">
            <a href="#">Tiempo</a>
            <a href="#">Contáctanos</a>
            <a href="#">Minijuego</a>
            <a href="#">Recomendaciones</a>
        </div>
        <div class="navbar-right">
            <img src="profile.jpg" alt="Foto de perfil" class="profile-pic">
            <span class="profile-name">Nombre del Cliente</span>
        </div>
    </nav>
    <div class="weather-container">
        <div class="weather-app">
            <form class="search-form" action="">
                <input class="city-input" type="text" placeholder="Ingrese el nombre de la ciudad">
                <button class="search-btn" type="submit">
                    <i class="material-icons">search</i>
                </button>
            </form>
            <div class="city-date-section">
                <h2 class="city">Clima en Barranquilla</h2>
                <p class="date">15 Abr 2024</p>
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
    <script src="../js/script.js"></script>
</body>
</html>
