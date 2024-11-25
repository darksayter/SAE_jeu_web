from flask import Flask, request, jsonify
import subprocess
import os
import tempfile

app = Flask(__name__)

@app.route('/')
def index():
    return open('templates/index.html').read()

@app.route('/execute', methods=['POST'])
def execute_code():
    data = request.get_json()
    code = data.get('code')

    # Exécuter le code et récupérer la sortie
    output, error = run_code(code)

    return jsonify({"output": output, "error": error})

def run_code(code):
    try:
        # Créer un fichier temporaire pour stocker le code Python
        with tempfile.NamedTemporaryFile(suffix=".py", delete=False) as temp_file:
            temp_file.write(code.encode())
            temp_file.close()

            # Exécuter le code via subprocess
            result = subprocess.run(
                ['python3', temp_file.name],
                capture_output=True, text=True, timeout=5
            )

            # Supprimer le fichier temporaire après exécution
            os.remove(temp_file.name)

            return result.stdout, result.stderr
    except subprocess.TimeoutExpired:
        return "Le code a pris trop de temps à s'exécuter.", ""
    except Exception as e:
        return f"Erreur lors de l'exécution: {str(e)}", ""

if __name__ == '__main__':
    app.run(debug=True)
