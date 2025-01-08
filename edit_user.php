<?php
session_start();

include 'controllers/connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_utilisateur'])) {
    $id_utilisateur = $_POST['id_utilisateur'];
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mail = $_POST['mail'];
    $admin = $_POST['admin'];

    try {
        $con = new PDO($dsn);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête de mise à jour
        $stmt = $con->prepare("UPDATE Utilisateur SET nom_utilisateur = :nom_utilisateur, mail = :mail, admin = :admin WHERE id_utilisateur = :id_utilisateur");
        $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':admin', $admin);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);

        // Exécuter la requête
        $stmt->execute();

        echo "Utilisateur mis à jour avec succès.";
    } catch (PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
    }
} else {
    echo "Requête non valide.";
}
?>