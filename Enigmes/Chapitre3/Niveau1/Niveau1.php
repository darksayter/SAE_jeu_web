<?php
    include '../../header_e.php';

    include '../../../controllers/connexion_bdd.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
    <style>
        .container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }
        .roulette {
            text-align: center;
            font-family: Arial, sans-serif;
            border: 2px solid black;
            border-radius: 10px;
            padding: 20px;
            width: 80px;
        }
        .number {
            font-size: 40px;
            margin: 20px 0;
        }
        .arrow {
            cursor: pointer;
            font-size: 30px;
            user-select: none;
        }
        .submit-btn {
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2 style="text-align: center; margin-top: 50px;">Déverrouillez ce cadenas pour accéder au test</h2>

<p style="text-align: center;">La combinaison du cadenas suit les règles suivantes :<br>
1. La somme de tous les chiffres doit être égale à 21.<br>
2. Tous les chiffres sont différents.<br>
3. Le premier chiffre est la racine cubique du deuxième.<br>
4. Mon cinquème chiffre est la somme du troisième et du double du quatrième<br>
5. Mon quatrième chiffre est le triple du troisième<br><br>
Trouvez la bonne combinaison !</p>

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
    <div class="roulette">
        <div class="arrow" onclick="changeNumber(4, 1)">▲</div>
        <div class="number" id="num4">0</div>
        <div class="arrow" onclick="changeNumber(4, -1)">▼</div>
    </div>
</div>

<button class="submit-btn" onclick="checkCombination()">Soumettre</button>

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
        const e = parseInt(document.getElementById('num4').innerText);

        if (a + b + c + d + e === 21 && 
            a === 2 &&
            b === 8 &&
            e === (2* d) + c && 
            d === (3 * c) ){
            <?
                $id_user = $_SESSION['id_utilisateur'];
                $stmt = $con->prepare('INSERT INTO niveaucomplete (id_utilisateur, id_niveau, score) VALUES (:id_user, 4, 500)');
                $stmt->bindParam(':id_user', $id_user);
                $stmt->execute();
            ?>
            alert("Bravo ! Vous avez ouvert le cadenas avec la bonne combinaison.");
        } else {
            alert("Dommage, la combinaison est incorrecte. Essayez encore !");
        }
    }
</script>

</body>
</html>
<?php
    include '../../footer_e.php';
?>