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
    <link rel="stylesheet" href="../css/styles-inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="icon" href="../images/logoGuardianes.png" type="image/x-icon"> <!-- Añadir favicon -->
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#"><i class="fas fa-home"></i></a>
        </div>
        <div class="navbar-center">
            <a href="../templates/inicio.php">Inicio</a>
            <a href="../templates/descubre.php">Descubre</a>
            <a href="#sobre-nosotros">Sobre nosotros</a>
            <a href="../templates/juego.php">¡Ponte a prueba!</a>
            <a href="../templates/">Recomendaciones</a>
            <a href="#contacto">Contáctanos</a>
            <form action="cerrarSesion.php" method="post" style="display:inline;">
                <button type="submit" class="logout-btn">Cerrar Sesión</button>
            </form>
        </div>
    </nav>

    <section id="inicio" class="main-content">
        <div class="texto-izquierda">
            <h1 class="editable-text">GUARDIANES DEL CLIMA:</h1>
            <h2 class="editable-text">La Estrategia para Salvar Nuestro Futuro</h2>
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
    </section>

    <section id="sobre-nosotros" class="about-us">
        <h2>Sobre Nosotros</h2>
        <p>Somos una organización dedicada a la protección del medio ambiente y la lucha contra el cambio climático. Nuestro objetivo es educar y concienciar a las personas sobre la importancia de cuidar nuestro planeta.</p>
        <div class="mission">
            <h3>Nuestra Misión</h3>
            <p>Promover prácticas sostenibles y responsables que ayuden a mitigar los efectos del cambio climático. Trabajamos con comunidades locales, gobiernos y organizaciones internacionales para implementar proyectos que protejan el medio ambiente.</p>
        </div>
        <div class="vision">
            <h3>Nuestra Visión</h3>
            <p>Un mundo donde todas las personas vivan en armonía con la naturaleza, disfrutando de un entorno limpio y saludable. Aspiramos a ser líderes en la lucha contra el cambio climático y la protección del medio ambiente.</p>
        </div>
        <div class="values">
            <h3>Nuestros Valores</h3>
            <ul>
                <li><strong>Sostenibilidad:</strong> Fomentamos el uso responsable de los recursos naturales.</li>
                <li><strong>Innovación:</strong> Buscamos soluciones creativas y efectivas para los desafíos ambientales.</li>
                <li><strong>Colaboración:</strong> Trabajamos en conjunto con diversas entidades para lograr nuestros objetivos.</li>
                <li><strong>Educación:</strong> Creemos en la importancia de educar a las futuras generaciones sobre la protección del medio ambiente.</li>
            </ul>
        </div>
        <div class="team">
            <h3>Conoce a Nuestro Equipo</h3>
            <div class="team-member">
                <img src="../images/leo.png" alt="Miembro del equipo 1">
                <h4>Leonardo Barraza</h4>
                <p>Director Ejecutivo</p>
            </div>
            <div class="team-member">
                <img src="../images/jenn.jpg" alt="Miembro del equipo 2">
                <h4>Jenifer Lopez</h4>
                <p>Coordinadora de Proyectos</p>
            </div>
            <div class="team-member">
                <img src="../images/emanuel.png" alt="Miembro del equipo 3">
                <h4>Emanuel Barranco</h4>
                <p>Especialista en Educación Ambiental</p>
            </div>
        </div>
    </section>

    <section id="contacto" class="contact">
        <h2>Contáctanos</h2>
        <form action="enviarCorreo.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="mensaje" required></textarea>
            </div>
            <button type="submit">Enviar</button>
        </form>
    </section>

    <footer class="footer">
        <div class="footer-section">
            <h3>Atención al Cliente</h3>
            <p>Teléfono: 123-456-7890</p>
            <p>Email: atencion@gmail.com</p>
        </div>
        <div class="footer-section">
            <h3>Políticas</h3>
            <p><a href="#">Política de Privacidad</a></p>
            <p><a href="#">Términos y Condiciones</a></p>
        </div>
        <div class="footer-section">
            <h3>Nuestras Redes Sociales</h3>
            <p><a href="https://www.facebook.com/jenifer.p.lopez.50"><i class="fab fa-facebook"></i> Facebook</a></p>
            <p><a href="#"><i class="fab fa-twitter"></i> Twitter</a></p>
            <p><a href="https://www.instagram.com/jenn_lopez0614/"><i class="fab fa-instagram"></i> Instagram</a></p>
        </div>
    </footer>
    <script src="../js/scriptlocal.js" data-ciudad="<?php echo $ciudadUsuario; ?>"></script>
</body>
</html>
