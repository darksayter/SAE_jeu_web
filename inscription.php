<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
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
  margin-left : -10px;
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
    <h1>Inscription</h1>
    <form method="post" action="controllers/check_inscription.php" autocomplete="off">
        <!-- Formulaire d'inscription -->
        <div class="input-container">
            <label for="nom_utilisateur">Pseudo</label>
            <input id="nom_utilisateur" name="nom_utilisateur" type="text" placeholder="Entrez votre pseudo" required />
        </div>

        <div class="input-container">
            <label for="mail">E-mail</label>
            <input id="mail" name="email" type="email" placeholder="Entrez votre e-mail" required />
        </div>

        <div class="input-container">
            <label for="mdp">Mot de passe</label>
            <input id="mdp" name="mdp" type="password" placeholder="8 caractères, 1 spécial, 1 maj minimum" required />
        </div>

        <div class="avatar-container">
            <label for="avatar">Choisissez votre avatar :</label>
            <div class="avatar-preview">
                <img id="avatar-image" src="assets/IMAGES/user_profil.png" alt="avatar">
            </div>
            <div class="avatar-selector">
                <button type="button" id="prev-avatar">&#8592;</button>
                <button type="button" id="next-avatar">&#8594;</button>
            </div>
        </div>

        <input type="hidden" id="avatar" name="avatar" value="assets/IMAGES/user_profil.png">

        <div class="button-container">
            <button type="submit" class="submit" name="submit_registration">S'inscrire</button>
        </div>
        
        <!-- Formulaire de vérification de code -->
        <?php if (isset($show_verification_form) && $show_verification_form): ?>
            <div class="input-container">
                <label for="code_verification">Code de vérification</label>
                <input id="code_verification" name="code_verification" type="text" placeholder="Entrez le code reçu" required />
            </div>

            <div class="button-container">
                <button type="submit" class="submit" name="submit_verification">Vérifier le code</button>
            </div>
        <?php endif; ?>

    </form>

    <a href="login.php"> Déjà un compte ? Connectez vous</a>
</div>

<script>
    const avatars = [
        'assets/IMAGES/user_profil.png',
        'assets/IMAGES/avatar1.jpg',
        'assets/IMAGES/avatar2.jpg',
        'assets/IMAGES/avatar3.jpg',
        'assets/IMAGES/avatar4.jpg',
        'assets/IMAGES/avatar5.jpg',
        'assets/IMAGES/avatar6.jpg',
        'assets/IMAGES/avatar7.jpg',
        'assets/IMAGES/avatar8.jpg',
        'assets/IMAGES/avatar9.jpg',
        'assets/IMAGES/avatar10.jpg',
        'assets/IMAGES/avatar11.jpg',
        'assets/IMAGES/avatar12.jpg',
        'assets/IMAGES/avatar13.jpg'
    ];
    let currentAvatarIndex = 0;

    const avatarImage = document.getElementById('avatar-image');
    const prevButton = document.getElementById('prev-avatar');
    const nextButton = document.getElementById('next-avatar');
    const avatarInput = document.getElementById('avatar');

    prevButton.addEventListener('click', () => {
        currentAvatarIndex = (currentAvatarIndex - 1 + avatars.length) % avatars.length;
        updateAvatar();
    });

    nextButton.addEventListener('click', () => {
        currentAvatarIndex = (currentAvatarIndex + 1) % avatars.length;
        updateAvatar();
    });

    function updateAvatar() {
        avatarImage.src = avatars[currentAvatarIndex];
        avatarInput.value = avatars[currentAvatarIndex];
    }
</script>

</body>
</html>
