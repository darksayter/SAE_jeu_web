<?php
    include '../../header_e.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
<style>    
    .document-enigme {
        all: unset;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin-top: 20px;
        flex-direction: column;
    }
    
    .indice-cards {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
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
    }

    .indice-card:hover {
        transform: scale(1.1);
        box-shadow: 0 0 20px #00ff00, 0 0 30px #00ff00 inset;
    }

    .indice-card h2 {
        font-size: 14px;
        margin: 0;
        text-shadow: 0 0 5px #008000;
    }

    @keyframes glow {
        0%, 100% {
            text-shadow: 0 0 10px #00ff00, 0 0 20px #008000;
        }
        50% {
            text-shadow: 0 0 20px #00ff00, 0 0 40px #008000;
        }
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
<script>
    let nb_indice = 0;
    function showIndice(indice) {
        alert("Indice " + indice + ": " + getIndiceText(indice));
    }

    function getIndiceText(indice) {
        switch(indice) {
            case 1: 
                nb_indice = 1;
                return "Indice 1: Ceci est l'indice numéro 1.";           
            case 2: 
                nb_indice = 2;
                return "Indice 2: Un indice supplémentaire pour la question.";
            case 3: 
                nb_indice = 3;
                return "Indice 3: Le dernier indice, utilisez-le bien!";
            default: 
                return "Indice inconnu.";
        }
        <?php 
            // echo "<script>var php_nb_indice = nb_indice;</script>";
            // $nb_indice = "<script>document.write(php_nb_indice);</script>";
            // $id_user = $_SESSION['id_utilisateur'];
            // $con = new PDO($dsn);
            // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // // Préparer la requête de mise à jour
            // $stmt = $con->prepare('INSERT INTO Indice (id_utilisateur, id_niveau, num_indice) VALUES (:id_user, 3, :nb_indice)');
            // $stmt->bindParam(':id_user', $id_user);
            // $stmt->bindParam(':nb_indice',$nb_indice );
            // // Exécuter la requête
            // $stmt->execute();
        ?>
    }
</script>

</head>
<body class="body">
<br><br>
<div class="container" style="text-align : center;">
	<span id="text"></span><span class="cursor">_</span>
</div>
<script src="../../../../assets/JAVASCRIPT/niveau3.js"></script>
<div class="document-enigme">
    <div class="document">
        <h1>Document d'Énigmes</h1>
        
        <form id="enigmeForm">
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
            
            <button type="button" class="submit-button" onclick="checkAnswers()">Soumettre</button>
        </form>
        <button class="admission-button" id="admissionButton" onclick="redirectToBonus()">Obtenir mon admission</button>
        
        <div class="indice-cards">
            <div class="indice-card" onclick="showIndice(1)">
                <h2>Indice 1</h2>
            </div>
            <div class="indice-card" onclick="showIndice(2)">
                <h2>Indice 2</h2>
            </div>
            <div class="indice-card" onclick="showIndice(3)">
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
                alert(`La réponse à la question "${key}" est incorrecte.`);
                break;
            }
        }

        if (isCorrect) {
            alert("Félicitations ! Toutes les réponses sont correctes.");
            document.getElementById("admissionButton").style.display = "block"; // Afficher le bouton
        }
    }

    // Fonction pour rediriger vers la page bonus
    function redirectToBonus() {
        window.location.href = "../../Chapitre1/Bonus/bonus.php";
    }
</script>

</body>

<?php
    include '../../../footer.php';
?>
