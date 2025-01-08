<?php
session_start();
include 'header.php';
include 'controllers/connexion_bdd.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_utilisateur'])) {
    $id_utilisateur = $_SESSION['id_utilisateur'];

    try {
        $con = new PDO($dsn);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer l'avatar de l'utilisateur
        $stmt = $con->prepare("SELECT avatar FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $avatar = !empty($user['avatar']) ? htmlspecialchars($user['avatar']) : './assets/IMAGES/user_profil.png';

        // Récupérer le chapitre le plus élevé complété
        $stmt = $con->prepare("SELECT MAX(id_chapitre) AS max_chapitre FROM chapitrecomplete WHERE id_utilisateur = :id_utilisateur");
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();

        $chapitres_completes = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        exit();
    }
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    include "login.php";
    exit();
}

// Fonction pour vérifier si un chapitre est complété
function isChapitreComplete($chapitre_id, $chapitres_completes) {
    return in_array($chapitre_id, $chapitres_completes);
}

// Définir les chapitres
$chapitres = [
    1 => ['nom' => 'Chapitre 1 : Nom du chapitre', 'description' => 'Description du chapitre : chapitre 1 ', 'url' => 'Enigmes/Chapitre1/selection_niveaux1.php'], 
    2 => ['nom' => 'Chapitre 2 : Nom du chapitre', 'description' => 'Description du chapitre : blablabla', 'url' => 'Enigmes/Chapitre2/selection_niveaux2.php'],
    3 => ['nom' => 'Chapitre 3 : Nom du chapitre', 'description' => 'Description du chapitre : blablabla', 'url' => 'Enigmes/Chapitre3/selection_niveaux3.php'],
    4 => ['nom' => 'Chapitre 4 : Nom du chapitre', 'description' => 'Description du chapitre : blablabla', 'url' => 'Enigmes/Chapitre4/selection_niveaux4.php'],
    5 => ['nom' => 'Chapitre 5 : Chapitre Bonus', 'description' => 'Description du chapitre bonus : blablabla', 'url' => 'Enigmes/Chapitre5/selection_niveaux5.php'],
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Progression des Chapitres</title>
    <link rel="stylesheet" href="./assets/CSS/style.css" type="text/css">
    <style>
        .progress-container {
            position: relative;
            width: 90%;
            height: 300px;
            background: #1a1a1d;
            border: 1px solid #00ff6c;
            border-radius: 10px;
            overflow: hidden;
            margin: 20px auto;
            margin-top : 10px;
        }

        .progress-line {
            position: absolute;
            top: 50%;
            left: 5%;
            width: 90%;
            height: 5px;
            background: #00ff6c;
            transform: translateY(-50%);
        }

        .chapter-point {
            position: absolute;
            width: 30px;
            height: 30px;
            background: #555;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            color: white;
            font-weight: bold;
            transform: translate(-50%, -50%);
            cursor: pointer;
        }

        .tooltip {
            position: absolute;
            background-color: black;
            color: white;
            padding: 10px;
            margin-top : 0px;
            border-radius: 8px;
            display: none;
            width: 280px;
            text-align: center;
            
    		transform: translateX(-50%); /* Centrer le tooltip horizontalement */
        }

        .tooltip h4 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .tooltip p {
            margin: 5px 0;
            font-size: 16px;
        }

        .tooltip a {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #00ff6c;
            color: black;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .profile-icon {
            position: absolute;
            width: 50px;
            height: 50px;
            transform: translate(-50%, -50%);
        }

        .profile-icon img {
            width: 100%;
            border-radius: 50%;
            border: 3px solid #00ff6c;
        }
    </style>
</head>
<body>

<div class="content">
  <!-- TITRE -->
  <br>
  <div class="container">
  <span id="text"></span><span class="cursor">_</span>
  </div>
  <script src="assets/JAVASCRIPT/ecriture_chapitres.js"></script>
  <br>
        
<div class="progress-container">
    <!-- Ligne horizontale pour la progression -->
    <div class="progress-line"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const chapters = [
        <?php foreach ($chapitres as $id => $chapitre): ?>,
            {
                id: <?php echo $id; ?>,
                name: "<?php echo htmlspecialchars($chapitre['nom']); ?>",
                description: "<?php echo htmlspecialchars($chapitre['description']); ?>",
                url: "<?php echo htmlspecialchars($chapitre['url']); ?>"
            },
        <?php endforeach; ?>
    ];

    const container = document.querySelector(".progress-container");
    const progressLine = document.querySelector(".progress-line");

    // Créer une boîte (tooltip)
    const tooltip = document.createElement("div");
    tooltip.className = "tooltip";
    container.appendChild(tooltip);

    const lineWidth = progressLine.offsetWidth;
    const lineLeft = progressLine.offsetLeft;

    // Positionner les points sur la ligne
    chapters.forEach((chapter, index) => {
        const progress = index / (chapters.length - 1);
        const positionX = lineLeft + progress * lineWidth;

        const chapterPoint = document.createElement("div");
        chapterPoint.className = "chapter-point";
        chapterPoint.style.left = `${positionX}px`;
        chapterPoint.style.top = "50%"; // Aligné verticalement au milieu
        chapterPoint.textContent = chapter.id;

        chapterPoint.addEventListener("mouseenter", () => {
            tooltip.innerHTML = `
                <h4>${chapter.name}</h4>
                <p>${chapter.description}</p>
                <a href="${chapter.url}" class="play-button">Jouer</a>
            `;
            tooltip.style.left = `${positionX}px`;
            tooltip.style.top = `${chapterPoint.offsetTop + 40}px`; // Positionner en dessous
            tooltip.style.display = "block";
        });

        chapterPoint.addEventListener("mouseleave", () => {
            setTimeout(() => {
                tooltip.style.display = "none";
            }, 5000);
        });

        container.appendChild(chapterPoint);
    });

    // Positionner l'avatar
    const userProgress = <?php echo json_encode(!empty($chapitres_completes) ? max($chapitres_completes) : 1); ?>;
    //const userPosition = lineLeft + ((userProgress - 1) / (chapters.length - 1)) * lineWidth;
    
    const userPosition = lineLeft + ((userProgress - 1) / (chapters.length - 1)) * lineWidth - 50; // Décaler de 20px vers la gauche


    const profileIcon = document.createElement("div");
    profileIcon.className = "profile-icon";
    profileIcon.style.left = `${userPosition}px`;
    profileIcon.style.top = "50%";

    const avatarImg = document.createElement("img");
    avatarImg.src = "<?php echo $avatar; ?>";
    profileIcon.appendChild(avatarImg);

    container.appendChild(profileIcon);
});

</script>

<br><br><br>
<?php include 'footer.php'; ?>
</body>
</html>