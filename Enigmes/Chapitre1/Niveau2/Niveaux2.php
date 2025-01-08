<?php
    include '../../header_e.php';
    include '../../../controllers/connexion_bdd.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
    <style>
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
            margin-top: -100px;
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
</script>
</body>

<?php
    //include '../../../footer.php';
?>

</html>
