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
        <div class="navbar-brand">
            <img src="../images/logoGuardianes.png" alt="Logo" class="nav-logo">
        </div>
        <div class="navbar-center">
            <a href="../templates/inicio.php" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Inicio</span>
            </a>
            <a href="../templates/descubre.php" class="nav-link">
                <i class="fas fa-compass"></i>
                <span>Descubre</span>
            </a>
            <a href="#sobre-nosotros" class="nav-link">
                <i class="fas fa-users"></i>
                <span>Sobre nosotros</span>
            </a>
            <a href="../templates/juego.php" class="nav-link">
                <i class="fas fa-gamepad"></i>
                <span>¡Ponte a prueba!</span>
            </a>
            <a href="../templates/blog.php" class="nav-link">
                <i class="fas fa-lightbulb"></i>
                <span>Recomendaciones</span>
            </a>
            <a href="#contacto" class="nav-link">
                <i class="fas fa-envelope"></i>
                <span>Contáctanos</span>
            </a>
        </div>
        <div class="navbar-right">
            <form action="cerrarSesion.php" method="post">
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Cerrar Sesión</span>
                </button>
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
        <div class="about-cards">
            <div class="about-card">
                <h3>Nuestra Misión</h3>
                <p>Promover prácticas sostenibles y responsables que ayuden a mitigar los efectos del cambio climático.</p>
            </div>
            <div class="about-card">
                <h3>Nuestra Visión</h3>
                <p>Un mundo donde todas las personas vivan en armonía con la naturaleza, disfrutando de un entorno limpio y saludable.</p>
            </div>
            <div class="about-card">
                <h3>Nuestros Valores</h3>
                <p>Sostenibilidad, Innovación, Colaboración y Educación son los pilares que guían nuestras acciones.</p>
            </div>
        </div>
    </section>

    <section class="team">
        <div class="section-header">
            <h2>Nuestro Equipo</h2>
            <p>Conoce a las personas detrás de Guardianes del Clima</p>
        </div>
        <div class="team-container">
            <div class="team-member">
                <div class="member-image-wrapper">
                    <div class="member-image">
                        <img src="../images/leo.png" alt="Leonardo Barraza">
                        <div class="member-overlay">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-member-info">
                    <h4>Leonardo Barraza</h4>
                    <p class="member-role">Director Ejecutivo</p>
                    <p class="member-desc">Especialista en gestión ambiental y desarrollo sostenible</p>
                </div>
            </div>

            <div class="team-member">
                <div class="member-image-wrapper">
                    <div class="member-image">
                        <img src="../images/jenn.jpg" alt="Jenifer Lopez">
                        <div class="member-overlay">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-member-info">
                    <h4>Jenifer Lopez</h4>
                    <p class="member-role">Coordinadora de Proyectos</p>
                    <p class="member-desc">Experta en educación ambiental y comunicación</p>
                </div>
            </div>

            <div class="team-member">
                <div class="member-image-wrapper">
                    <div class="member-image">
                        <img src="../images/emanuel.png" alt="Emanuel Barranco">
                        <div class="member-overlay">
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="team-member-info">
                    <h4>Emanuel Barranco</h4>
                    <p class="member-role">Especialista en Educación Ambiental</p>
                    <p class="member-desc">Líder en programas de concientización ambiental</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contacto" class="contact">
        <div class="contact-container">
            <div class="contact-info">
                <div class="contact-header">
                    <h2>¡Conversemos!</h2>
                    <p>Estamos aquí para escuchar tus ideas y responder tus preguntas sobre el medio ambiente</p>
                </div>
                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Ubicación</h3>
                            <p>Barranquilla, Colombia</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Teléfono</h3>
                            <p>+57 123 456 7890</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Email</h3>
                            <p>info@guardianesdelclima.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form-wrapper">
                <form class="contact-form" action="enviarCorreo.php" method="post">
                    <div class="form-header">
                        <h3>Envíanos un mensaje</h3>
                        <p>Nos pondremos en contacto contigo pronto</p>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-container">
                                <i class="fas fa-user"></i>
                                <input type="text" name="nombre" placeholder="Tu nombre" required>
                            </div>
                            <div class="input-container">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="correo" placeholder="Tu correo" required>
                            </div>
                        </div>
                        <div class="input-container">
                            <i class="fas fa-tag"></i>
                            <input type="text" name="asunto" placeholder="Asunto" required>
                        </div>
                        <div class="input-container">
                            <i class="fas fa-pen"></i>
                            <textarea name="mensaje" placeholder="Tu mensaje" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">
                        <span>Enviar Mensaje</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
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
