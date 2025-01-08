<?php
session_start();

if (!isset($_SESSION['id_utilisateur'])) {
    die("Vous devez être connecté pour supprimer une équipe.");
}

$id_utilisateur = $_SESSION['id_utilisateur'];
$id_equipe = isset($_POST['id_equipe']) ? $_POST['id_equipe'] : null;

if ($id_equipe === null) {
    echo "ID de l'équipe non spécifié.";
    exit(0);
}

include 'connexion_bdd.php';

try {
    $con = new PDO($dsn);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier que l'utilisateur est bien le leader de l'équipe
    $sql_check = "SELECT * FROM Equipe WHERE id_equipe = :id_equipe AND id_leader = :id_utilisateur";
    $stmt_check = $con->prepare($sql_check);
    $stmt_check->bindParam(':id_equipe', $id_equipe, PDO::PARAM_INT);
    $stmt_check->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $stmt_check->execute();

    if ($stmt_check->rowCount() === 0) {
        die("Vous n'êtes pas autorisé à supprimer cette équipe.");
    }

    // Mettre à jour tous les utilisateurs pour supprimer l'association avec l'équipe
    $sql_update_users = "UPDATE Utilisateur SET id_equipe = NULL WHERE id_equipe = :id_equipe";
    $stmt_update_users = $con->prepare($sql_update_users);
    $stmt_update_users->bindParam(':id_equipe', $id_equipe, PDO::PARAM_INT);
    $stmt_update_users->execute();

    // Supprimer l'équipe
    $sql_delete = "DELETE FROM Equipe WHERE id_equipe = :id_equipe";
    $stmt_delete = $con->prepare($sql_delete);
    $stmt_delete->bindParam(':id_equipe', $id_equipe, PDO::PARAM_INT);

    if ($stmt_delete->execute()) {
        echo "Équipe supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'équipe.";
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}
?>