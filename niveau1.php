<?php
    include '../../../header.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
<style>
    .document-enigme {
        all: unset; /* Réinitialisation des styles hérités */
        font-family: 'Times New Roman', Times, serif;
        color: black;
        padding: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .document-enigme .document {
        width: 800px;
        background: white;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid #ddd;
    }

    .document-enigme .document h1 {
        text-align: center;
        text-decoration: underline;
        margin-bottom: 20px;
        font-size: 24px;
    }

    .document-enigme .question {
        margin-bottom: 20px;
    }

    .document-enigme .question label {
        font-size: 18px;
        display: block;
        margin-bottom: 10px;
    }

    .document-enigme .question input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .document-enigme .submit-button {
        display: block;
        width: 100%;
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 15px;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }

    .document-enigme .submit-button:hover {
        background-color: #0056b3;
    }

    .indice-cards {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .indice-card {
        width: 75px; /* Taille réduite */
        height: 100px; /* Taille réduite */
        background: linear-gradient(45deg, #2c3e50, #34495e);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.5s ease;
        position: relative;
        overflow: hidden;
        margin: 0 -10px; /* Les coins se touchent légèrement */
    }

    /* Rotations pour un éventail subtil */
    .indice-card:first-child {
        transform: rotate(-10deg);
        z-index: 1; /* Priorité visuelle */
    }

    .indice-card:nth-child(2) {
        transform: rotate(0deg);
        z-index: 2; /* Priorité visuelle */
    }

    .indice-card:last-child {
        transform: rotate(10deg);
        z-index: 1; /* Priorité visuelle */
    }

    .indice-card:hover {
        transform: scale(1.1); /* Effet d'agrandissement au survol */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3), 0 0 15px rgba(255, 255, 255, 0.4);
        background: linear-gradient(135deg, #1abc9c, #94ffe4, #9b59b6);
        background-size: 300% 300%;
        animation: gradient-shift 3s ease infinite;
        z-index: 3; /* Mettre en avant la carte survolée */
    }

    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .indice-card::before {
        content: '';
        position: absolute;
        top: -100%;
        left: -100%;
        width: 300%;
        height: 300%;
        background: radial-gradient(circle, rgba(255,255,255,0.2), rgba(255,255,255,0) 70%);
        transform: rotate(-45deg);
        opacity: 0;
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .indice-card:hover::before {
        opacity: 1;
        transform: rotate(0deg);
    }

    .indice-card h2 {
        font-size: 14px; /* Ajusté pour la nouvelle taille */
        text-align: center;
        margin: 0;
        padding: 0;
        z-index: 1;
        position: relative;
    }


</style>
</head>
<body class="body">
<script>
    function showIndice(indice) {
        alert("Indice " + indice + ": " + getIndiceText(indice));
    }

    function getIndiceText(indice) {
        switch(indice) {
            case 1: return "Indice 1: Ceci est l'indice numéro 1.";
            case 2: return "Indice 2: Un indice supplémentaire pour la question.";
            case 3: return "Indice 3: Le dernier indice, utilisez-le bien!";
            default: return "Indice inconnu.";
        }
    }
</script>

<div class="document-enigme">
    <div class="document">
        <h1>Document d'Énigmes</h1>
        
        <form action="niveau1.php" method="POST">
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
            
            <button type="submit" class="submit-button" style="margin-bottom : 50px">Soumettre</button>
        </form>

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
</body>

<?php
    include '../../../footer.php';
?>