<?php
ob_start();
include '../../header_e.php';
include '../../../controllers/connexion_bdd.php';
session_start();
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
            flex-direction: column;
            margin-top : -100px;
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
            text-transform: uppercase;}

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
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

        .next-level {
            margin-top: 20px;
            display: inline-block;
            font-size: 18px;
            color: #00ff00;
            text-decoration: none;
            text-transform: uppercase;
            border: 1px solid #00ff00;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .next-level:hover {
            background: #008000;
            color: black;
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

        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(black, #001a00);
            opacity: 0.05;
            z-index: -1;
        }
        
        .container{margin-top : 40px;}
        
        body {background: linear-gradient(to right, #40819F, #313650);}
    </style>
</head>

<body class="body">   

<div class="container" style="text-align : center;">
	<span id="text"></span><span class="cursor">_</span>
</div>
<script src="../../../../assets/JAVASCRIPT/niveau1.js"></script>
  
    <script>
        function showSuccess() {
            alert("Bravo ! Vous avez trouvé les bonnes informations.");}
        function showFailure() {
            alert("Identifiant ou mot de passe incorrect. Essayez encore !");}
    </script>

    <div class="document-enigme">
        <div class="document">
            <h1>Connexion au test</h1>
            <h3> Pour vous connectez vous devez trouver l'identifiant et le mot de passe (ils sont cachés sur cette page) </h3>
            
            
            <?php
            $hidden_username = "superuser";
            $hidden_password = "cryptographie";

            $id_user = $_SESSION['id_utilisateur'];
            $success = false;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';

                if ($username === $hidden_username && $password === $hidden_password) {
                    echo "<script>showSuccess();</script>";
                    $success = true;
                    try {
                        $con = new PDO($dsn);
                        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                        // Préparer la requête de mise à jour
                        $stmt = $con->prepare('INSERT INTO niveaucomplete (id_utilisateur, id_niveau, score, num_chap) VALUES (:id_user, 1, 500, 1)');
                        $stmt->bindParam(':id_user', $id_user);
                
                        // Exécuter la requête
                        $stmt->execute();
                    } catch (PDOException $e) {
                        echo 'Erreur de connexion : ' . $e->getMessage();
                    }
                } else {
                    echo "<script>showFailure();</script>";
                }
            }
            ?>

            <form class="login-form" method="POST" action="">
                <label for="username">Identifiant :</label>
                <input type="text" id="username" name="username" placeholder="Entrez l'identifiant" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Entrez le mot de passe" required>

                <button type="submit" class="submit-button">Se connecter</button>
            </form>

            <?php if ($success): ?>
                <a href="../Niveau2/Niveaux2.php" class="next-level">→ Aller au niveau suivant</a>
            <?php endif; ?>
        </div>
    </div>
    </div>
</body>

<?php
    include '../../../footer.php';
    ob_end_flush();
?>
