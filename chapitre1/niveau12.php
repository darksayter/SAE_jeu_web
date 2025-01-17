<?php
ob_start();
include '../../../header.php';
include '../../../controllers/connexion_bdd.php';
session_start();
?>
<head>
    <link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
    <style>
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

        .document-enigme {
            all: unset;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .document-enigme .document {
            width: 800px;
            background: rgba(0, 0, 0, 0.9);
            padding: 20px;
            box-shadow: 0 0 10px #00ff00;
            border: 1px solid #00ff00;
            text-align: center;
        }

        .document-enigme h1, .document-enigme h3 {
            color: #00ff00;
        }

        .document-enigme h1 {
            font-size: 40px;
            text-transform: uppercase;
            text-shadow: 0 0 10px #00ff00;
            animation: glow 1.5s infinite;
        }

        .document-enigme h3 {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .login-form label {
            display: block;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
            color: #00ff00;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 90%;
            padding: 10px;
            font-size: 14px;
            background-color: black;
            color: #00ff00;
            border: 1px solid #00ff00;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .login-form input[type="text"]::placeholder,
        .login-form input[type="password"]::placeholder {
            color: #008000;
        }

        .submit-button {
            display: block;
            width: 100%;
            background: #00ff00;
            color: black;
            border: none;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
            transition: background 0.3s ease;
        }

        .submit-button:hover {
            background: #008000;
        }

        @keyframes glow {
            0% {
                text-shadow: 0 0 5px #00ff00;
            }
            50% {
                text-shadow: 0 0 20px #00ff00;
            }
            100% {
                text-shadow: 0 0 5px #00ff00;
            }
        }

        /* Boîte de notification */
        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #00ff00;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 15px #00ff00;
            display: none; /* Cache le message par défaut */
            z-index: 9999;
            width: 300px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
    </style>
</head>

<body class="body">
<div class="document-enigme">
    <div class="document">
        <h1>Connexion au test</h1>
        <h3>Pour vous connectez vous devez trouver l'identifiant et le mot de passe (ils sont cachés sur cette page)</h3>

        <?php
        // Gestion de la connexion et du message d'insertion
        $hidden_username = "superuser";
        $hidden_password = "cryptographie";

        $id_user = $_SESSION['id_utilisateur'];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Si l'utilisateur se connecte
            if ($username === $hidden_username && $password === $hidden_password) {
                echo "<script>var success = true;</script>";
                $success = true;
                $nb_indice = isset($_POST['nb_indice']) ? (float)$_POST['nb_indice'] : 1;
                $score = 500 * $nb_indice;
                try {
                    $con = new PDO($dsn);
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                    $stmt = $con->prepare('INSERT INTO niveaucomplete (id_utilisateur, id_niveau, score, num_chap) VALUES (:id_user, 1, :score, 1)');
                    $stmt->bindParam(':id_user', $id_user);
                    $stmt->bindParam(':score', $score );
            
                    $stmt->execute();
                } catch (PDOException $e) {
                    echo 'Erreur de connexion : ' . $e->getMessage();
                }
            } else {
                echo "<script>var success = false;</script>";
            }
        }

        // Fonction pour vérifier si l'indice a déjà été utilisé
        function isIndiceAlreadyUsed($userId, $indice, $levelId) {
            global $dsn;
            try {
                $con = new PDO($dsn);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Vérification de l'existence de l'indice pour cet utilisateur et ce niveau
                $stmt = $con->prepare('SELECT COUNT(*) FROM Indice WHERE id_utilisateur = :userId AND num_indice = :indice AND id_niveau = :levelId');
                $stmt->bindParam(':userId', $userId);
                $stmt->bindParam(':indice', $indice);
                $stmt->bindParam(':levelId', $levelId);
                $stmt->execute();

                $result = $stmt->fetchColumn();

                return $result > 0; // Si le résultat est supérieur à 0, cela signifie que l'indice est déjà utilisé
            } catch (PDOException $e) {
                echo 'Erreur de vérification : ' . $e->getMessage();
                return false;
            }
        }

        // Insertion d'un indice dans la base de données si il n'existe pas déjà
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['indice'])) {
            $indice = $_POST['indice']; // Récupère l'indice
            $levelId = 1; // Niveau actuel (ici, supposé être niveau 1)

            // Vérification de l'indice avant insertion
            if (!isIndiceAlreadyUsed($id_user, $indice, $levelId)) {
                try {
                    $con = new PDO($dsn);
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Insertion de l'indice dans la base de données
                    $stmt = $con->prepare('INSERT INTO Indice (id_utilisateur, id_niveau, num_indice) VALUES (:id_user, :levelId, :indice)');
                    $stmt->bindParam(':id_user', $id_user);
                    $stmt->bindParam(':levelId', $levelId);
                    $stmt->bindParam(':indice', $indice);
                    $stmt->execute();

                    $message = "Indice $indice ajouté avec succès à la base de données!";
                } catch (PDOException $e) {
                    $message = "Erreur lors de l'insertion des données : " . $e->getMessage();
                }
            } else {
                $message = "L'indice $indice a déjà été utilisé dans ce niveau.";
            }
        }
        ?>

        <form class="login-form" method="POST" action="">
            <label for="username">Identifiant :</label>
            <input type="text" id="username" name="username" placeholder="Entrez l'identifiant" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Entrez le mot de passe" required>

            <button class="submit-button" type="submit">Se connecter</button>
        </form>

        <div class="indice-cards">
            <div class="indice-card" onclick="submitIndice(1)">
                <h2>Indice 1</h2>
            </div>
            <div class="indice-card" onclick="submitIndice(2)">
                <h2>Indice 2</h2>
            </div>
        </div>
    </div>
</div>

<!-- Boîte de notification -->
<div id="notification" class="notification">
    <p id="notification-message"></p>
</div>

<script>
    if (typeof success !== "undefined") {
        if (success) {
            alert("Bravo ! Vous avez réussi à vous connecter au test, le plus dur commence maintenant !");
            window.location.href = "../Niveau2/Niveaux2.php";
        } else {
            alert("Identifiant ou mot de passe incorrect. Essayez encore !");
        }
    }

    
    function submitIndice(indice) {
        var formData = new FormData();
        formData.append("indice", indice);

        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            var notification = document.getElementById('notification');
            var message = document.getElementById('notification-message');

            // Affiche un message personnalisé pour chaque indice
            if (indice === 1) {
                message.innerHTML = "Voici l'indice 1";
            } else if (indice === 2) {
                message.innerHTML = "Voici l'indice 2";
            }

            notification.style.display = 'block';
            notification.style.opacity = '1';

            // Masquer le message après 3 secondes
            setTimeout(function() {
                notification.style.opacity = '0';
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 500); // Masquer complètement après la transition
            }, 3000); // Après 3 secondes
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    }
</script>

</body>
