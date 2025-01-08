<?php
session_start();
include 'controllers/connexion_bdd.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_utilisateur'])) {
    $id_utilisateur = $_SESSION['id_utilisateur'];

    try {
        $con = new PDO($dsn);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête pour récupérer l'avatar
        $stmt = $con->prepare("SELECT avatar FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // Vérifier si l'utilisateur a un avatar
        $avatar = !empty($user['avatar']) ? htmlspecialchars($user['avatar']) : './assets/IMAGES/user_profil.png';

    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        exit();
    }
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    include "login.php";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1345c63d83.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="assets/IMAGES/askey.png">
    <link rel="stylesheet" href="./assets/CSS/style.css" type="text/css" />
</head>

<!-- HEADER -->
<header class="tete">
    <div class="header_wrapper">
        <!-- Logo -->
        <div class="header_logo">
            <a href="index.php">
                <img src="./assets/IMAGES/askey.png" alt="logo">
            </a>
        </div>
        <!-- Menu -->
        <nav class="principale">
            <ul>
                <li class="deroulant"><a href="index.php">Accueil</a></li>
                <li class="deroulant"><a href="chapitres.php">Liste des chapitres</a></li>
                <li class="deroulant"><a href="equipes.php">Equipes</a></li>
                <li class="deroulant"><a href="classement.php">Classement</a></li>
            </ul>
        </nav>
        <!-- Profile Image and Dropdown Menu -->
        <div class="header_profile">
            <div class="profile_dropdown">
                <!-- Profile Image -->
                <a href="#" class="profile_image">
                    <img src="<?php echo $avatar; ?>" alt="Profile">
                </a>
                <!-- Dropdown Menu -->
                <div class="dropdown_menu">
                    <a href="profil.php">Mon Profil</a>
                    <a href="Teamroom/chat.php">Chatroom</a>
                    <a href="controllers/delog.php">Se déconnecter</a>
                </div>
            </div>
        </div>
    </div>
</header>