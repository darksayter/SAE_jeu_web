from flask import Flask, request, jsonify, render_template

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')  # Remplacez 'index.html' par le nom de votre fichier HTML

@app.route('/submit', methods=['POST'])
def submit_data():
    data = request.get_json()
    user_input = data.get('userInput')

    with open('output.txt', 'a') as f:
        f.write(user_input + '\n')

    return jsonify({"message": "Données reçues et enregistrées"}), 200

if __name__ == '__main__':
    app.run(debug=True)
