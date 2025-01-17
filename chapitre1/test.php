<?php
    include 'header.php';
?>
<head>
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

    /* Applique les styles uniquement à votre document */
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

</style>
</head>
<body class="body">
<script src="niveau1.js"></script>
<div class = "document-enigme">
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
            
            <button type="submit" class="submit-button">Soumettre</button>
        </form>
    </div>
</div>
</body>

<?php
    include 'footer.php';
?>
