<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Indices</title>
    <link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background: linear-gradient(to right, #40819F, #313650);
        }

        /* Style inspiré des indices */
        .indice-card {
            width: 80px;
            height: 120px;
            background: rgba(0, 0, 0, 0.9);
            color: #00ff00;
            border: 2px solid #00ff00;
            border-radius: 10px;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 0 10px #00ff00;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 10px;
        }

        .indice-card:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px #00ff00, 0 0 30px #00ff00 inset;
        }

        .message {
            margin-top: 20px;
            font-size: 18px;
            color: blue;
        }

        .disabled {
            background: rgba(128, 128, 128, 0.6);
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="document-enigme">
        <div class="document">
            <h1>Indices disponibles</h1>

            <!-- Affichage du nombre d'indices utilisés -->
            <div id="indice-count">
                <p>Indices utilisés : <span id="count-indices">0</span></p>
            </div>

            <div id="button1" class="indice-card">
                <h2>Indice 1</h2>
            </div>
            <div id="button2" class="indice-card">
                <h2>Indice 2</h2>
            </div>
        </div>
    </div>

    <script>
        // Fonction pour récupérer le count des indices utilisés
        function getIndiceCount() {
            fetch('indice.php', {
                method: 'POST',
                body: JSON.stringify({ getIndiceCount: true }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.count !== undefined) {
                    document.getElementById('count-indices').innerText = data.count;
                    updateButtons(data.count);  
                } else {
                    console.error("Erreur:", data.error);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        }

        // Appel initial pour récupérer le count des indices utilisés
        

        function updateButtons(count) {
            const button1 = document.getElementById('button1');
            const button2 = document.getElementById('button2');

            // Le bouton 1 est toujours disponible
            button1.classList.remove('disabled');
            count2 = parseInt(count, 10);
            if (count2 === 0) {
                
                button2.classList.add('disabled');
            } else {
                button2.classList.remove('disabled');
            }
        }
        getIndiceCount();

        function sendIndice(indice) {
            // Afficher un pop-up
            alert("Vous avez appuyé sur l'indice " + indice);
            
            // Envoi de la requête au backend avec le numéro d'indice
            fetch('indice.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ indice: indice }) // Envoie du numéro d'indice
            })
            .then(() => {
                // Après l'insertion de l'indice, on récupère le nouveau count
                getIndiceCount();
            })
            .catch(error => {
                console.error('Erreur lors de l\'insertion :', error);
            });

            // Afficher un message local sans attendre la réponse du backend
            const clientMessage = document.getElementById('clientMessage');
            clientMessage.textContent = "Commande pour l'indice " + indice + " envoyée au serveur.";
        }

        // Ajout des événements aux boutons
        document.getElementById('button1').addEventListener('click', function () {
            sendIndice(1); // Envoi de l'indice 1
        });

        document.getElementById('button2').addEventListener('click', function () {
            // Si le bouton 2 est désactivé, on simule la sélection du bouton 1
            const count = parseInt(document.getElementById('count-indices').innerText);
            if (count === 0) {
                // Si on essaie de cliquer sur l'indice 2 sans avoir utilisé l'indice 1
                alert("L'indice 1 doit être utilisé avant l'indice 2.");
                sendIndice(1); // Envoie de l'indice 1 au lieu de l'indice 2
            } else {
                sendIndice(2); // Envoi de l'indice 2
            }
        });
    </script>
</body>
</html>
