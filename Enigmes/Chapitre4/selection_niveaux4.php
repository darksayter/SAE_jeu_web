<?php
    session_start();

    include '../header.php';

    // Inclure le fichier de connexion à la base de données
    include '../../controllers/connexion_bdd.php';    

    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['id_utilisateur'])) {
        $id_utilisateur = $_SESSION['id_utilisateur'];

        try {
            $con = new PDO($dsn);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparer la requête pour récupérer la valeur de deblocage_final
            $stmt = $con->prepare("SELECT deblocage_finale FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
            $stmt->bindParam(':id_utilisateur', $id_utilisateur);
            
            // Exécuter la requête
            $stmt->execute();

            // Récupérer la valeur de deblocage_final
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $deblocage_finale = $user['deblocage_finale'];

            // Préparer les requêtes pour vérifier si chaque niveau est complété
            $niveau_complete = [];
            for ($i = 1; $i <= 3; $i++) {
                $stmt = $con->prepare("SELECT id_niveau FROM niveaucomplete WHERE id_utilisateur = :id_utilisateur AND id_niveau = :id_niveau");
                $stmt->bindParam(':id_utilisateur', $id_utilisateur);
                $stmt->bindParam(':id_niveau', $i);
                
                // Exécuter la requête
                $stmt->execute();

                // Vérifier si le niveau est complété
                $niveau_complete[$i] = $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        header('Location: ../login.php');
        exit();
    }
?>

    <style>
        .disabled {
            background-color:rgb(150, 204, 248);
            pointer-events: none;
        }
    </style>
<body class="body">
    <div class="content">
        <h1 class="main-title">Chapitre 4</h1>
        <p class="description">
            Veuillez sélectionner le niveau de votre choix.
        </p>
        <div class="button-container">
            <div class="row">
                <a href="Niveau1/Niveau1.php" class="custom-button">Niveau 1</a>
            </div>
            <div class="row">
                <a href="Niveau2/Niveaux2.php" class="custom-button <?php echo $niveau_complete[1] ? '' : 'disabled'; ?>">Niveau 2</a>
            </div>
            <div class="row">
                <a href="Niveau3/Niveaux3.php" class="custom-button <?php echo $niveau_complete[2] ? '' : 'disabled'; ?>">Niveau 3</a>
            </div>
            <div class="row">
                <a href="Bonus/bonus.php" class="custom-button <?php echo $deblocage_finale >= 1 ? '' : 'disabled'; ?>">Niveau Bonus</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
</body>
</html>