from flask import Flask, request, jsonify
import subprocess
import html

app = Flask(__name__)
app.config['JSON_AS_ASCII'] = False

def obtener_respuesta_llama(prompt):
    try:
        comando = f'ollama run llama3 "{prompt}"'
        resultado = subprocess.check_output(comando, shell=True, text=True, encoding='utf-8')
        # Decodificar y limpiar la respuesta
        resultado = html.unescape(resultado)
        return resultado.strip()
    except Exception as e:
        return f"Error al conectar con Ollama: {str(e)}"

@app.route('/chat', methods=['POST'])
def procesar_prompt():
    data = request.json
    prompt = data.get('prompt')
    resultado = obtener_respuesta_llama(prompt)
    response = jsonify({'respuesta': resultado})
    response.headers['Content-Type'] = 'application/json; charset=utf-8'
    return response

if __name__ == "__main__":
    app.run(port=5000)
