<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <link rel="stylesheet" href="../css/styles-index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="icon" href="ruta-del-favicon.ico" type="image/x-icon"> <!-- Añadir favicon -->
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="#"><i class="fas fa-home"></i></a>
        </div>
        <div class="navbar-center">
            <a href="#inicio">Inicio</a>
            <a href="#descubre">Descubre</a>
            <a href="#sobre-nosotros">Sobre nosotros</a>
            <a href="#juego">¡Ponte a prueba!</a>
            <a href="#recomendaciones">Recomendaciones</a>
            <a href="#contacto">Contáctanos</a>
            <a href="#iniciar-sesion">Iniciar sesión</a>
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
        <div class="carousel">
            <!-- Carrusel de imágenes -->
            <div class="carousel-item active">
                <img src="ruta-de-la-imagen1.jpg" alt="Imagen 1">
            </div>
            <div class="carousel-item">
                <img src="ruta-de-la-imagen2.jpg" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="ruta-de-la-imagen3.jpg" alt="Imagen 3">
            </div>
        </div>
    </section>

    <section id="sobre-nosotros" class="about-us">
        <h2>Sobre Nosotros</h2>
        <p>Somos una organización dedicada a la protección del medio ambiente y la lucha contra el cambio climático. Nuestro objetivo es educar y concienciar a las personas sobre la importancia de cuidar nuestro planeta.</p>
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
            <p>Email: atencion@ejemplo.com</p>
        </div>
        <div class="footer-section">
            <h3>Políticas</h3>
            <p><a href="#">Política de Privacidad</a></p>
            <p><a href="#">Términos y Condiciones</a></p>
        </div>
        <div class="footer-section">
            <h3>Nuestras Redes Sociales</h3>
            <p><a href="#"><i class="fab fa-facebook"></i> Facebook</a></p>
            <p><a href="#"><i class="fab fa-twitter"></i> Twitter</a></p>
            <p><a href="#"><i class="fab fa-instagram"></i> Instagram</a></p>
        </div>
    </footer>
</body>
</html>
