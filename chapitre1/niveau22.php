<?php
    include '../../../header.php';
    include '../../../controllers/connexion_bdd.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
    <style>
    	body{background: linear-gradient(to right, #40819F, #313650);}
        
        .container_global {
            position: absolute;
            top: 75%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            display: grid;
            justify-content: center;
            border: 2px solid black;
            border-radius: 15px;
            padding: 50px;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
        }

        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: -75px;
        }

        .roulette {
            text-align: center;
            font-family: Arial, sans-serif;
            border: 2px solid black;
            border-radius: 10px;
            padding: 20px;
            width: 80px;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .number {
            font-size: 45px;
            color: #f8f8f8;
            text-shadow: 2px 2px 8px #000;
            margin: 20px 0;
            animation: fadeIn 0.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0.5;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .arrow {
            cursor: pointer;
            font-size: 20px;
            color: #00ff00;
            text-shadow: 1px 1px 5px #000;
            transition: transform 0.2s;
        }

        .arrow:hover {
            transform: scale(1.2);
        }

        .submit-btn {
            margin-top: 30px;
            padding: 10px 20px;
            background: linear-gradient(45deg, #40819F, #335571);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .submit-btn:hover {
            background: linear-gradient(45deg, #333954, #1b2d45);
            transform: scale(1.1);
        }

        h1 {
        	margin-top : 20px;
            text-align: center;
            font-size: 80px;
        }

        p {
            font-size: 20px;
        }

        .next-level {
            display: none;
            margin-top: 20px;
            text-align: center;
        }

        .next-level a {
            text-decoration: none;
            padding: 10px 20px;
            background: linear-gradient(45deg, #4CAF50, #357A38);
            color: white;
            border-radius: 10px;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .next-level a:hover {
            background: linear-gradient(45deg, #357A38, #235623);
            transform: scale(1.1);
        }
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
            border: 2px solid rgb(255, 42, 0);
            background: rgba(128, 128, 128, 0.6);
            cursor: not-allowed;
        }

        .abled {
            border: 2px solid rgb(103, 214, 255);
            background: rgba(46, 51, 54, 0.6);
            cursor: not-allowed;
        }
        
        .container{margin-top: -50px;}
    </style>
</head>
<body>

<br><br>
<div class="container" style="text-align : center;">
	<span id="text"></span><span class="cursor">_</span>
</div>
<script src="../../../../assets/JAVASCRIPT/niveau2.js"></script>

<div class="container_global">

    <p style="text-align: center; margin-top : -10px;">La combinaison du cadenas suit les règles suivantes :<br>
        1. La somme de tous les chiffres doit être égale à 11.<br>
        2. Mon troisième chiffre est le double du premier.<br>
        3. Mon deuxième chiffre est le triple du quatrième.<br><br>
        Trouvez la bonne combinaison !
    </p><br><br><br>

    <div class="container">
        <div class="roulette">
            <div class="arrow" onclick="changeNumber(0, 1)">▲</div>
            <div class="number" id="num0">0</div>
            <div class="arrow" onclick="changeNumber(0, -1)">▼</div>
        </div>
        <div class="roulette">
            <div class="arrow" onclick="changeNumber(1, 1)">▲</div>
            <div class="number" id="num1">0</div>
            <div class="arrow" onclick="changeNumber(1, -1)">▼</div>
        </div>
        <div class="roulette">
            <div class="arrow" onclick="changeNumber(2, 1)">▲</div>
            <div class="number" id="num2">0</div>
            <div class="arrow" onclick="changeNumber(2, -1)">▼</div>
        </div>
        <div class="roulette">
            <div class="arrow" onclick="changeNumber(3, 1)">▲</div>
            <div class="number" id="num3">0</div>
            <div class="arrow" onclick="changeNumber(3, -1)">▼</div>
        </div>
    </div>

    <button class="submit-btn" onclick="checkCombination()">Soumettre</button>
    
    <div class="next-level" id="nextLevel">
        <a href="../Niveau3/Niveaux3.php">→ Aller au niveau suivant</a>
    </div>


    <div class="document">
            <h4>Indices disponibles</h4>

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
    function changeNumber(index, direction) {
        const numberElement = document.getElementById('num' + index);
        let currentNumber = parseInt(numberElement.innerText);
        currentNumber = (currentNumber + direction + 10) % 10;
        numberElement.innerText = currentNumber;
    }

    function checkCombination() {
        const a = parseInt(document.getElementById('num0').innerText);
        const b = parseInt(document.getElementById('num1').innerText);
        const c = parseInt(document.getElementById('num2').innerText);
        const d = parseInt(document.getElementById('num3').innerText);

        if (a + b + c + d === 11 && 
            c === (2 * a) && 
            b === (3 * d)) {
            // Insérer dans la base de données
            <?php
                $id_user = $_SESSION['id_utilisateur'];
                $stmt = $con->prepare('INSERT INTO niveaucomplete (id_utilisateur, id_niveau, score, num_chap) VALUES (:id_user, 2, 500, 1)');
                $stmt->bindParam(':id_user', $id_user);
                $stmt->execute();
            ?>
            alert("Bravo ! Vous avez ouvert le cadenas avec la bonne combinaison.");
            document.getElementById('nextLevel').style.display = 'block'; // Afficher le lien
        } else {
            alert("Dommage, la combinaison est incorrecte. Essayez encore !");
        }
    }

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
                if (count2 === 1) {
                
                button1.classList.add('abled');
                } else {
                    if (count2 === 2) {
                    button1.classList.add('abled');
                    button2.classList.add('abled');
                    } 
                }
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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</html>

<?php
// Inclure le footer
include '../../../footer.php';
ob_end_flush();
?>