<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../css/styles-iniciarSesion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="procesarLogin.php" method="post">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required>
            
            <label for="contrasena">Contraseña</label>
            <div class="password-container">
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            
            <div class="recuerdame">
                <input type="checkbox" id="recuerdame" name="recuerdame">
                <label for="recuerdame">Recuérdame</label>
            </div>
            
            <button type="submit">Iniciar Sesión</button>
        </form>
        <p class="registro">¿Aún no tienes cuenta? <a href="registrarse.php">Regístrate aquí :)</a></p>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#contrasena');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
