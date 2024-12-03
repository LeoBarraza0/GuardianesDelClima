from flask import Flask, request, jsonify
from flask_cors import CORS
import subprocess
import json

app = Flask(__name__)
CORS(app)  # Esto permite peticiones desde cualquier origen

@app.route('/chat', methods=['POST'])
def chat():
    try:
        data = request.json
        prompt = data.get('prompt', '')
        
        # Ejecutar el comando de Ollama
        comando = f'ollama run llama3 "{prompt}"'
        resultado = subprocess.check_output(comando, shell=True, text=True)
        
        return jsonify({
            'status': 'success',
            'respuesta': resultado
        })
    except Exception as e:
        return jsonify({
            'status': 'error',
            'error': str(e)
        }), 500

if __name__ == '__main__':
    app.run(port=5000) 