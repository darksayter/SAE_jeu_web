<?php
    session_start();

    include 'header.php';

    // Inclure le fichier de connexion à la base de données
    include 'controllers/connexion_bdd.php';    

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
            for ($i = 1; $i <= 5; $i++) {
                $stmt = $con->prepare("SELECT id_niveau FROM niveaucomplete WHERE id_utilisateur = :id_utilisateur AND id_niveau = :id_niveau");
                $stmt->bindParam(':id_utilisateur', $id_utilisateur);
                $stmt->bindParam(':id_niveau', $i);
                
                // Exécuter la requête
                $stmt->execute();

                // Vérifier si le niveau est complété
                $niveau_complete[$i] = $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
            }
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
            exit(0);
        }
    } else {
        echo "Utilisateur non connecté.";
        exit(0);
    }

// id_niveau	diff_info	diff_crypto	diff_logique	nb_indices	numero	
// 1	1	1	1	3	1
// INSERT INTO Niveau (id_niveau, diff_info, diff_crypto, diff_logique, nb_indices, numero) VALUES (1, 1, 1, 1, 3, 1);

// INSERT INTO niveaucomplete (id_utilisateur, id_niveau) VALUES (4, 1);

?>


<!-- BODY -->
<body>
    <div class="content">
        <!-- TITRE -->
        <h1 class="main-title">Les niveaux</h1>
        <!-- Description -->
        <p class="description">
            abcdefghijklmnopqrstuvwxyz, abcdefghijklmnopqrstuvwxyz.
        </p>
        <!-- Boutons -->
        <div class="button-container">
            <div class="row">
                <a href="Niveaux1.php" class="custom-button">Niveaux 1</a>
            </div>
            <?php if ($niveau_complete[1]): ?>
                <div class="row">
                    <a href="Niveaux2.php" class="custom-button">Niveaux 2</a>
                </div>
            <?php endif; ?>
            <?php if ($niveau_complete[2]): ?>
                <div class="row">
                    <a href="Niveaux3.php" class="custom-button">Niveaux 3</a>
                </div>
            <?php endif; ?>
            <?php if ($niveau_complete[3]): ?>
                <div class="row">
                    <a href="Niveaux4.php" class="custom-button">Niveaux 4</a>
                </div>
            <?php endif; ?>
            <?php if ($niveau_complete[4]): ?>
                <div class="row">
                    <a href="Niveaux5.php" class="custom-button">Niveaux 5</a>
                </div>
            <?php endif; ?>
            <?php if ($deblocage_finale == 1): ?>
                <div class="row">
                    <a href="niveau_cache.php" class="custom-button">Niveau Bonus</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <br>
    <br>
</body>

<?php
    include 'footer.php';
?>