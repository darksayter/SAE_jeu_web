<?php
include 'controllers/connexion_bdd.php';

if (isset($_GET['id'])) {
    $id_utilisateur = $_GET['id'];

    try {
        $con = new PDO($dsn);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête de suppression
        $stmt = $con->prepare("DELETE FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);

        // Exécuter la requête
        $stmt->execute();

        header('Location: admin_utilisateur.php');
        exit(0);
    } catch (PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
        exit(0);
    }
} else {
    echo "Requête non valide.";
    exit(0);
}
?>