<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles-registrarse.css">
    <title>Registrarse</title>
</head>
<body>
    <div class="container">
        <div class="form-left">
            <h1>Registrarse</h1>
            <form action="submit_registration.php" method="post">
                <div class="form-group">
                    <label for="nombres">Nombres</label>
                    <input type="text" id="nombres" name="nombres" required>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Número telefónico</label>
                    <input type="text" id="telefono" name="telefono" required>
                </div>
                <div class="form-group">
                    <label for="pais">País</label>
                    <input type="text" id="pais" name="pais" required>
                </div>
            </form>
        </div>
        <div class="form-right">
            <form action="submit_registration.php" method="post">
                <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" id="ciudad" name="ciudad" required>
                </div>
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" id="correo" name="correo" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>
                <div class="form-group recuerdame">
                    <input type="checkbox" id="recordarme" name="recordarme">
                    <label for="recordarme">Recuérdame</label>
                </div>
                <div class="form-group">
                    <p>¿Ya tienes cuenta? <a href="../templates/iniciarSesion.php">Iniciar sesión ahora :)</a></p>
                </div>
                <div class="form-group">
                    <button type="submit">¡Registrarse Ya!</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
