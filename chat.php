<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Chat con LLaMA</title>
    <style>
        #respuesta {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0;
            min-height: 100px;
        }
        .loading {
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <textarea id="prompt" rows="4" cols="50"></textarea>
    <button onclick="enviarPrompt()">Enviar</button>
    <div id="respuesta"></div>

    <script>
    function enviarPrompt() {
        const prompt = document.getElementById('prompt').value;
        const respuestaDiv = document.getElementById('respuesta');
        
        respuestaDiv.classList.add('loading');
        respuestaDiv.textContent = 'Procesando...';

        fetch('http://localhost:5000/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json; charset=UTF-8',
                'Accept': 'application/json; charset=UTF-8'
            },
            body: JSON.stringify({ 
                prompt: prompt,
                language: 'es'  // Especificar español como idioma
            })
        })
        .then(response => response.json())
        .then(data => {
            respuestaDiv.classList.remove('loading');
            respuestaDiv.textContent = htmlspecialchars(data.respuesta);
        })
        .catch(error => {
            respuestaDiv.classList.remove('loading');
            respuestaDiv.textContent = 'Error: ' + error;
        });
    }
    </script>
</body>
</html> 