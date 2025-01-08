<?php
    include 'header.php';
    session_start();

    // Inclure le fichier de connexion à la base de données
    include 'controllers/connexion_bdd.php';

    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['id_utilisateur'])) {
        $id_utilisateur = $_SESSION['id_utilisateur'];

        try {
            $con = new PDO($dsn);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparer la requête pour récupérer les informations de l'utilisateur
            $stmt = $con->prepare("SELECT * FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
            $stmt->bindParam(':id_utilisateur', $id_utilisateur);
            
            // Exécuter la requête
            $stmt->execute();

            // Récupérer les informations de l'utilisateur
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Préparer la requête pour récupérer le niveau le plus élevé de l'utilisateur
            $stmt = $con->prepare("SELECT MAX(id_niveau) AS niveau_max FROM niveaucomplete WHERE id_utilisateur = :id_utilisateur");
            $stmt->bindParam(':id_utilisateur', $id_utilisateur);
            
            // Exécuter la requête
            $stmt->execute();

            // Récupérer le niveau le plus élevé de l'utilisateur
            $niveau = $stmt->fetch(PDO::FETCH_ASSOC);
            $niveau_max = $niveau['niveau_max'];

            // Vérifier si l'utilisateur a une équipe
            if (!empty($user['id_equipe'])) {
                // Préparer la requête pour récupérer le nom de l'équipe
                $stmt = $con->prepare("SELECT nom_equipe FROM Equipe WHERE id_equipe = :id_equipe");
                $stmt->bindParam(':id_equipe', $user['id_equipe']);
                
                // Exécuter la requête
                $stmt->execute();

                // Récupérer le nom de l'équipe
                $equipe = $stmt->fetch(PDO::FETCH_ASSOC);
                $nom_equipe = $equipe['nom_equipe'];
            } else {
                $nom_equipe = "Sans équipe";
            }
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
            exit(0);
        }
    } else {
        echo "Utilisateur non connecté.";
        exit(0);
    }
?>

<!-- BODY -->
<body class="body">
<br>
    <div class="content">
    
        <div class="container">
            <span id="text"></span><span class="cursor">_</span>
        </div>
        <script src="assets/JAVASCRIPT/ecriture_profil.js"></script><br><br>
        
        <div class="profile-card">
            <div class="profile-left">
                <div class="profile-picture">
                    <img src="<?php echo $user['avatar'];?> " alt="Avatar">
                </div>
                <p class="profile-name"><?php echo htmlspecialchars($user['nom_utilisateur']); ?></p>
            </div>
            <div class="profile-right">
                <p class="profile-info"><strong>Mail :</strong> <?php echo htmlspecialchars($user['mail']); ?></p>
                <p class="profile-info"><strong>Niveau :</strong> <?php echo htmlspecialchars($niveau_max); ?></p>
                <p class="profile-info"><strong>Équipe :</strong> <?php echo htmlspecialchars($nom_equipe); ?></p>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br>
    
</body>

<?php
    include 'footer.php';
?>