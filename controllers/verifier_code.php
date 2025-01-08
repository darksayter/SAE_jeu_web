<?php
// Inclure le fichier de connexion à la base de données
include 'connexion_bdd.php';

// Vérifier si l'utilisateur soumet le formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $code_verification = $_POST['code_verification'];

    // Valider les données
    if (!empty($email) && !empty($code_verification)) {
        try {
            $con = new PDO($dsn);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Vérifier si l'utilisateur existe avec le bon code de vérification
            $stmt_check = $con->prepare("SELECT * FROM Utilisateur WHERE mail = :mail AND verification_code = :verification_code AND active = 0");
            $stmt_check->bindParam(':mail', $email);
            $stmt_check->bindParam(':verification_code', $code_verification);
            $stmt_check->execute();

            $user = $stmt_check->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Activer le compte
                $stmt_update = $con->prepare("UPDATE Utilisateur SET active = 1 WHERE mail = :mail");
                $stmt_update->bindParam(':mail', $email);
                $stmt_update->execute();

                // Rediriger vers la page de connexion ou une page de succès
                header('Location: login.php'); // Rediriger vers la page de connexion
                exit();
            } else {
                echo "Code de vérification incorrect ou le compte est déjà activé.";
            }
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de votre compte</title>
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="./assets/CSS/fond.css">
</head>
<body>
<style>
.input-container {margin-bottom: 15px;}

input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  margin-left: -10px;
}

.button-container {text-align: center;}

.submit {
  background-color: #0056b3;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
}

.submit:hover {background-color: #007BFF;}
</style>

<!-- Fond animé -->
<div class="hacker-background">
    <!-- Code de fond animé -->
</div>

<div class="form-container">
    <h1>Vérification de votre compte</h1>
    <form method="post" action="verifier_code.php" autocomplete="off">
        <!-- Formulaire de vérification -->
        <div class="input-container">
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email" placeholder="Entrez votre e-mail" required />
        </div>

        <div class="input-container">
            <label for="code_verification">Code de vérification</label>
            <input id="code_verification" name="code_verification" type="text" placeholder="Entrez le code reçu" required />
        </div>

        <div class="button-container">
            <button type="submit" class="submit" name="submit_verification">Vérifier le code</button>
        </div>

    </form>

    <a href="login.php">Retour à la connexion</a>
</div>

</body>
</html>
