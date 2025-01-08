<?php
// Connexion à la base de données
include('controllers/connexion_bdd.php');

try {
    // Créer une connexion PDO
    $con = new PDO($dsn);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}

if (isset($_POST['boutton-valider'])) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $erreur = "";
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <link rel="stylesheet" href="./assets/CSS/fond.css">
</head>
<body>

<!-- Fond animé -->
<div class="hacker-background">
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    <div class="code-line">_root@admin:~$ sudo apt-get install hacker-mode</div>
    <div class="code-line">Reading package lists... Done</div>
    
</div>

<!-- Rectangle central contenant le formulaire -->
<div class="centered-rectangle">
    <section class="form-container">
        <h1 class="form-title">Connexion</h1>
        <form action="controllers/check_login.php" method="POST" autocomplete="off" class="login-form">
            <div class="form-group">
                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" class="input-field" required>
            </div>
                        
            <div class="form-group">
              <label for="password">Mot de Passe</label>
              <input type="password" id="password" name="password" class="input-field" required>
              <img src="assets/IMAGES/oeil_ouvert.jpg" id="toggle-password" alt="Afficher/Masquer le mot de passe" style="cursor: pointer; width: 20px; height: 20px;">
          </div>

            <button type="submit" name="boutton-valider" class="submit-btn">Valider</button>
        </form>
        <a href="inscription.php" class="signup-link">Créer un compte</a>
    </section>
</div>

<!-- JavaScript pour afficher/masquer le mot de passe -->
<script>
const togglePassword = document.getElementById('toggle-password');
const passwordField = document.getElementById('password');

togglePassword.addEventListener('click', function() {
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        
        togglePassword.src = 'assets/IMAGES/oeil_ferme.png'; // Revenir à l'œil fermé
    } else {
        passwordField.type = 'password';
        togglePassword.src = 'assets/IMAGES/oeil_ouvert.jpg'; // Afficher l'œil ouvert
    }
});

    
    
</script>

