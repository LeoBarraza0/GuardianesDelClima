<?php
session_start();

$apiKey = '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';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prompt = $_POST['prompt'];
    
    // Simplificar el prompt
    $prompt_mejorado = $prompt;
    
    $data = [
        'inputs' => $prompt_mejorado,
        'parameters' => [
            'max_new_tokens' => 250,  // Número máximo de tokens a generar
            'temperature' => 0.7,     // Creatividad de la respuesta
            'top_p' => 0.9,          // Diversidad de la respuesta
            'do_sample' => true      // Permite generación más creativa
        ]
    ];

    // Cambiar al modelo GPT-2 que es mejor para generación de texto
    $ch = curl_init('https://api-inference.huggingface.co/models/gpt2');
    
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apiKey
    ]);

    $response = curl_exec($ch);
    $result = json_decode($response, true);

    if(curl_errno($ch)) {
        $error = "Error de CURL: " . curl_error($ch);
    }
    
    curl_close($ch);

    if (isset($result['error'])) {
        $error = "Error de API: " . $result['error'];
    } else if (isset($result[0]['generated_text'])) {
        // Limpiar y formatear la respuesta
        $respuesta = $result[0]['generated_text'];
        // Eliminar el prompt original de la respuesta
        $respuesta = str_replace($prompt_mejorado, '', $respuesta);
        $respuesta = trim($respuesta);
        if (empty($respuesta)) {
            $respuesta = "Lo siento, no pude generar una respuesta apropiada. Por favor, intenta reformular tu pregunta.";
        }
    } else {
        $error = "No se pudo generar una respuesta válida";
        $debug_response = print_r($result, true);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistente IA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .response {
            margin-top: 20px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border-left: 4px solid #28a745;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #f5c6cb;
        }
        textarea {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            padding: 12px 24px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #218838;
        }
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
        }
        .loading.active {
            display: block;
        }
        .debug-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            font-family: monospace;
            white-space: pre-wrap;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Asistente IA</h1>
        <form method="POST" id="questionForm">
            <textarea 
                name="prompt" 
                rows="4" 
                placeholder="Escribe tu pregunta aquí..."
                required
            ></textarea>
            <br>
            <button type="submit">Enviar pregunta</button>
        </form>

        <div class="loading" id="loading">
            Procesando tu pregunta... Por favor espera.
        </div>

        <?php if (isset($error)): ?>
            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>
            <?php if (isset($debug_response)): ?>
                <div class="debug-info">
                    <h4>Información de depuración:</h4>
                    <?php echo htmlspecialchars($debug_response); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (isset($respuesta)): ?>
            <div class="response">
                <h3>Respuesta:</h3>
                <p><?php echo nl2br(htmlspecialchars($respuesta)); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        document.getElementById('questionForm').onsubmit = function() {
            document.getElementById('loading').classList.add('active');
        };
    </script>
</body>
</html>