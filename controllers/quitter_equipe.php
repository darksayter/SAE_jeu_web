<?php
session_start();
include '../controllers/connexion_bdd.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    die("Vous devez être connecté pour effectuer cette action.");
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Vérifier si l'utilisateur a une équipe
$sql_check_team = "SELECT id_equipe FROM Utilisateur WHERE id_utilisateur = :id_utilisateur";
$stmt_check = $db->prepare($sql_check_team);
$stmt_check->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
$stmt_check->execute();
$user_team = $stmt_check->fetch(PDO::FETCH_ASSOC);

if (!$user_team || !$user_team['id_equipe']) {
    die("Vous n'êtes pas dans une équipe.");
}

$id_equipe = $user_team['id_equipe'];

try {
    // Démarrer une transaction
    $db->beginTransaction();

    // Mettre à jour la table Utilisateurs pour retirer l'utilisateur de son équipe
    $sql_remove_user = "UPDATE Utilisateur SET id_equipe = NULL WHERE id_utilisateur = :id_utilisateur";
    $stmt_remove_user = $db->prepare($sql_remove_user);
    $stmt_remove_user->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $stmt_remove_user->execute();

    // Décrémenter le nombre de joueurs dans l'équipe
    $sql_decrement_team = "UPDATE Equipe SET nombre_joueurs = nombre_joueurs - 1 WHERE id_equipe = :id_equipe";
    $stmt_decrement_team = $db->prepare($sql_decrement_team);
    $stmt_decrement_team->bindParam(':id_equipe', $id_equipe, PDO::PARAM_INT);
    $stmt_decrement_team->execute();

    // Valider la transaction
    $db->commit();

    // Rediriger l'utilisateur avec un message de succès
    header("Location: ../equipes.php");
    exit();
} catch (Exception $e) {
    // En cas d'erreur, annuler la transaction
    $db->rollBack();
    die("Erreur lors de la tentative de quitter l'équipe : " . $e->getMessage());
}
?>
