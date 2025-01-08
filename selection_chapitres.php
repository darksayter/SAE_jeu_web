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
            Veuillez sélectionner un chapitre.
        </p>
        <!-- Boutons -->
        <div class="button-container">
            <div class="row">
                <a href="Enigmes/Chapitre1/selection_niveaux1.php" class="custom-button">Chapitre 1</a>
            </div>
            <div class="row">
                <a href="Enigmes/Chapitre2/selection_niveaux2.php" class="custom-button">Chapitre 2</a>
            </div>
            <div class="row">
                <a href="Enigmes/Chapitre3/selection_niveaux3.php" class="custom-button">Chapitre 3</a>
            </div>
            <div class="row">
                <a href="Enigmes/Chapitre4/selection_niveaux4.php" class="custom-button">Chapitre 4</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
</body>

<?php
    include 'footer.php';
?>