<?php
include '../../header_e.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
<style>
    body {background: linear-gradient(to right, #40819F, #313650);}
    .document-enigme {
        all: unset;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin-top: 20px;
        flex-direction: column;
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
            background: rgba(128, 128, 128, 0.6);
            cursor: not-allowed;
        }
        .abled {
            border: 2px solid rgb(103, 214, 255);
            background: rgba(46, 51, 54, 0.6);
        }
    .document-enigme .document {
        width: 700px;
        background: rgba(0, 0, 0, 0.95);
        padding: 30px;
        box-shadow: 0 0 20px #00ff00, 0 0 60px #008000 inset;
        border: 2px solid #00ff00;
        text-align: center;
        margin-top: 20px;
        border-radius: 15px;
    }
    .document-enigme h1 {
        font-size: 30px;
        color: #00ff00;
        text-transform: uppercase;
        margin-bottom: 20px;
        text-shadow: 0 0 10px #00ff00, 0 0 20px #008000;
        animation: glow 1.5s infinite ease-in-out;
    }
    .document-enigme .question label {
        display: block;
        font-size: 16px;
        color: #00ff00;
        margin-bottom: 10px;
        text-shadow: 0 0 5px #00ff00;
        text-transform: uppercase;
    }
    .document-enigme .question input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        background-color: black;
        color: #00ff00;
        border: 1px solid #00ff00;
        border-radius: 4px;
        margin-bottom: 15px;
    }
    .document-enigme .question input::placeholder {
        color: #008000;
        font-style: italic;
    }
    .submit-button, .admission-button {
        display: block;
        width: 100%;
        background: linear-gradient(90deg, #00ff00, #006600);
        color: black;
        border: 1px solid #00ff00;
        padding: 15px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        text-transform: uppercase;
        transition: background 0.3s ease, transform 0.2s;
    }
    .submit-button:hover, .admission-button:hover {
        background: linear-gradient(90deg, #006600, #00ff00);
        transform: scale(1.05);
    }
    .admission-button {
        display: none; /* Caché par défaut */
        margin-top: 20px;
    }
    @keyframes glow {
        0%, 100% {
            text-shadow: 0 0 10px #00ff00, 0 0 20px #008000;
        }
        50% {
            text-shadow: 0 0 20px #00ff00, 0 0 40px #008000;
        }
    }
    
</style>

</head>
<body class="body">

<div class="container" style="text-align : center;">
    <span id="text"></span><span class="cursor">_</span>
</div>
<script src="../../../../assets/JAVASCRIPT/niveau3.js"></script>
<br><br>

<div class="document-enigme">
    <div class="document">
        <h1>Document d'Énigmes</h1>
        
        <form id="enigmeForm" method="POST" action="">
            <!-- Question 1 -->
            <div class="question">
                <label for="question1">1. Qu'est-ce qui est deux fois dans l'ouverture mais qu'une seule dans la fermeture ?</label>
                <input type="text" id="question1" name="question1" placeholder="Votre réponse ici">
            </div>
            
            <!-- Question 2 -->
            <div class="question">
                <label for="question2">2. Quel est le nombre qui suit : 1; 11; 121; 1331;...</label>
                <input type="text" id="question2" name="question2" placeholder="Votre réponse ici">
            </div>
            
            <!-- Question 3 -->
            <div class="question">
                <label for="question3">3. Quel est ce chiffre : 7AB7</label>
                <input type="text" id="question3" name="question3" placeholder="Votre réponse ici">
            </div>
            
            <!-- Question 4 -->
            <div class="question">
                <label for="question4">4. Décoder ceci : GWFAT; 5</label>
                <input type="text" id="question4" name="question4" placeholder="Votre réponse ici">
            </div>
            <input type="hidden" id="nb_indice" name="nb_indice" value="1">
            
            <button type="button" class="submit-button" onclick="checkAnswers()">Soumettre</button>
        </form>
        <button class="admission-button" id="admissionButton" onclick="redirectToBonus()">Obtenir mon admission</button>
        
        <div class="indice-cards">
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
            <div id="button3" class="indice-card">
                <h2>Indice 3</h2>
            </div>
        </div>

    </div>
</div>

<script>
    // Fonction pour valider les réponses
    function checkAnswers() {
        const answers = {
            question1: "u",
            question2: "14641", 
            question3: "31415", 
            question4: "bravo" 
        };

        let isCorrect = true;

        for (const [key, value] of Object.entries(answers)) {
            const userAnswer = document.getElementById(key).value.trim().toLowerCase();
            if (userAnswer !== value.toLowerCase()) {
                isCorrect = false;
                alert(La réponse à la question "${key}" est incorrecte.);
                break;
            }
        }

        if (isCorrect) {
            alert("Félicitations ! Toutes les réponses sont correctes.");
            document.getElementById("admissionButton").style.display = "block"; // Afficher le bouton

            // Mettre à jour le score dans la base de données
            <?php 
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $id_user = $_SESSION['id_utilisateur'];
            		$id_niveau = 3;
                    $nb_indice = 4;
                    $score = 500 * $nb_indice;
                    try {
    $con = new PDO($dsn);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
     $stmt = $con->prepare('SELECT COUNT(*) AS count FROM Indice WHERE id_utilisateur = :id_user AND id_niveau = :id_niveau');
                $stmt->bindParam(':id_user', $id_user);
                $stmt->bindParam(':id_niveau', $id_niveau);
                $stmt->execute();

                // Récupérer le résultat
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $result['count'];
                $nb_indice = 4 - $count;
                $score = 200 * $nb_indice;
                
    // Vérification préalable dans la table niveaucomplete
    $stmt_check = $con->prepare('SELECT COUNT(*) FROM niveaucomplete WHERE id_utilisateur = :id_user AND id_niveau = 3 AND num_chap = 1');
    $stmt_check->bindParam(':id_user', $id_user);
    $stmt_check->execute();
    $exists = $stmt_check->fetchColumn();

    if ($exists == 0) {
        // Si aucune ligne correspondante n'existe, insérer les données
        $stmt = $con->prepare('INSERT INTO niveaucomplete (id_utilisateur, id_niveau, score, num_chap) VALUES (:id_user, 3, :score, 1)');
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':score', $score);
        $stmt->execute();

        // Vérification préalable dans la table chapitrecomplete
        $stmt_check_chap = $con->prepare('SELECT COUNT(*) FROM chapitrecomplete WHERE id_utilisateur = :id_user AND id_chapitre = 1');
        $stmt_check_chap->bindParam(':id_user', $id_user);
        $stmt_check_chap->execute();
        $exists_chap = $stmt_check_chap->fetchColumn();

        if ($exists_chap == 0) {
            // Si aucune ligne correspondante n'existe, insérer dans chapitrecomplete
            $stmt_chap = $con->prepare("INSERT INTO chapitrecomplete (id_utilisateur, id_chapitre) VALUES (:id_user, 1)");
            $stmt_chap->bindParam(':id_user', $id_user);
            $stmt_chap->execute();
        }
    }
} catch (PDOException $e) {
                        echo 'Erreur de connexion : ' . $e->getMessage();
                    }
               
                }
            ?>
        }
    }

    // Fonction pour rediriger vers la page bonus
    function redirectToBonus() {
        window.location.href = "../../Chapitre1/Bonus/bonus.php";
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
            const button3 = document.getElementById('button3');
            // Le bouton 1 est toujours disponible
            button1.classList.remove('disabled');
            count2 = parseInt(count, 10);
            if (count2 === 0) {
                
                button2.classList.add('disabled');
                button3.classList.add('disabled');
            } else if (count2 === 1) {
                button2.classList.remove('disabled');
                button3.classList.add('disabled');
                button1.classList.add('abled');
            } else if (count2 === 2) {
                button2.classList.remove('disabled');
                button3.classList.remove('disabled');
                button1.classList.add('abled');
                button2.classList.add('abled');
                
            }
            else {
                button2.classList.remove('disabled');
                button3.classList.remove('disabled');
                button1.classList.add('abled');
                button2.classList.add('abled');
                button3.classList.add('abled');
            }
        }
        getIndiceCount();

        function sendIndice(indice) {
            let message;
            if (indice === 1) {
                message = "Pour le 1 on cherche quelque chose directement dans les mots.";
            } else if (indice === 2) {
                message = "Pour le 2 il faut connaitre le triangle de Pascal.";
            } else if (indice === 3) {
                message = "Le 3 est en hexa et on cherche un décimale. Le 4 est un code césar avec comme clé 5.";
            } else {
                message = "Indice inconnu.";
            }

            // Afficher le message personnalisé
            alert(message);

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



        document.getElementById('button3').addEventListener('click', function () {
            // Si le bouton 2 est désactivé, on simule la sélection du bouton 1
            const count = parseInt(document.getElementById('count-indices').innerText);
            if (count === 0) {
                // Si on essaie de cliquer sur l'indice 2 sans avoir utilisé l'indice 1
                alert("L'indice 1 doit être utilisé avant l'indice 3.");
                sendIndice(1); // Envoie de l'indice 1 au lieu de l'indice 2
            } else if (count === 1) {
                // Si on essaie de cliquer sur l'indice 2 sans avoir utilisé l'indice 1
                alert("L'indice 2 doit être utilisé avant l'indice 3.");
                sendIndice(2); // Envoie de l'indice 1 au lieu de l'indice 2
            }
            else {
                sendIndice(3); // Envoi de l'indice 2
            }
        });
</script>

<br>
<br>
<br>
<br>
<br>
</body>

<?php
// Inclure le footer
include '../../../footer.php';
?>


