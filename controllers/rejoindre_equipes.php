<?php
session_start();

include 'connexion_bdd.php';

if (!isset($_SESSION['id_utilisateur'])) {
    die("Vous devez être connecté pour effectuer cette action.");
}

$id_utilisateur = $_SESSION['id_utilisateur'];
$id_equipe = $_POST['id_equipe'];

// Ajouter l'utilisateur à l'équipe
$sql = "UPDATE Utilisateur SET id_equipe = :id_equipe WHERE id_utilisateur = :id_utilisateur";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id_equipe', $id_equipe, PDO::PARAM_INT);
$stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: ../equipes.php");
} else {
    die("Erreur lors de la mise à jour de l'équipe.");
}
?>
