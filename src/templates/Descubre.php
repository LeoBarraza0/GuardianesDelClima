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
            <a href="#">Recomendaciones</a>
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
        <p class="Recomendaciones">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequatur repellat veniam odit nihil iusto vel
            nesciunt non commodi, recusandae sapiente quibusdam deserunt iure. Laudantium dolorem ducimus aliquam
            asperiores esse fuga. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut necessitatibus hic
            sequi, autem dolore, blanditiis quo nostrum animi numquam velit eligendi quae quibusdam deserunt maxime
            quas, incidunt provident harum voluptatem. Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita vitae laboriosam qui facere suscipit odit, dolor ex doloribus animi dignissimos. Soluta non molestiae porro quos perspiciatis amet, animi ipsum dolorum!</p>
    </div>
    </div>
<script src="../js/scriptapi.js" data-ciudad="<?php echo $ciudadUsuario; ?>"></script>
</body>

</html>