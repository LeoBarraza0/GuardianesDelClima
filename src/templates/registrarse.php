<?php
session_start();
include '../../db.php';

// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug: Imprimir los datos recibidos
    error_log("Datos POST recibidos: " . print_r($_POST, true));

    $nombres = isset($_POST['nombres']) ? trim($_POST['nombres']) : '';
    $apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $pais = isset($_POST['pais']) ? trim($_POST['pais']) : '';
    $ciudad = isset($_POST['ciudad']) ? trim($_POST['ciudad']) : '';
    $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
    $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';
    $fechaRegistro = date('Y-m-d H:i:s');

    // Debug: Verificar los valores antes de la inserción
    error_log("Valores a insertar: ");
    error_log("Nombres: " . $nombres);
    error_log("Apellidos: " . $apellidos);
    error_log("Teléfono: " . $telefono);
    error_log("País: " . $pais);
    error_log("Ciudad: " . $ciudad);
    error_log("Correo: " . $correo);
    error_log("Fecha: " . $fechaRegistro);

    if (empty($nombres) || empty($apellidos) || empty($telefono) || 
        empty($pais) || empty($ciudad) || empty($correo) || empty($contrasena)) {
        $errorMsg = "Por favor, complete todos los campos.";
        error_log("Error: campos vacíos detectados");
    } else {
        try {
            // Verificar si el correo ya existe
            $stmt = $conn->prepare("SELECT IdUsuario FROM usuarios WHERE Correo = ?");
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $conn->error);
            }
            
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $errorMsg = "Este correo ya está registrado.";
                error_log("Error: correo duplicado");
            } else {
                // Insertar nuevo usuario
                $stmt = $conn->prepare("INSERT INTO usuarios (Nombres, Apellidos, Telefono, Pais, Ciudad, Correo, Contraseña, FechaRegistro) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                if (!$stmt) {
                    throw new Exception("Error en la preparación de la inserción: " . $conn->error);
                }
                
                $stmt->bind_param("ssssssss", $nombres, $apellidos, $telefono, $pais, $ciudad, $correo, $contrasena, $fechaRegistro);
                
                if (!$stmt->execute()) {
                    throw new Exception("Error en la ejecución de la inserción: " . $stmt->error);
                }
                
                error_log("Usuario registrado exitosamente. ID: " . $stmt->insert_id);
                header("Location: iniciarSesion.php");
                exit();
            }
        } catch (Exception $e) {
            error_log("Error en el proceso de registro: " . $e->getMessage());
            $errorMsg = "Error al registrar el usuario: " . $e->getMessage();
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logoGuardianes.png" type="image/x-icon"> <!-- Añadir favicon -->
    <link rel="stylesheet" href="../css/styles-registrarse.css">
    <title>Registrarse</title>
</head>
<body>
    <div class="container">
        <h1>Registrarse</h1>
        <div class="form-left">
            <form action="registrarse.php" method="post">
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
            <form action="registrarse.php" method="post">
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
            <img src="../images/logoGuardianes.png" alt="Logo" class="logo"> <!-- Añadir el logo aquí -->
        </div>
    </div>
</body>
</html>
