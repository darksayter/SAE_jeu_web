<?php
session_start();

include 'connexion_bdd.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    die("Vous devez être connecté pour créer une équipe.");
}

// Récupération des données
$nom_equipe = trim($_POST['nom_equipe']);
$id_leader = $_SESSION['id_utilisateur'];

try {
    // Vérifier si l'utilisateur a déjà une équipe
    $sql_check_leader = "SELECT * FROM Equipe WHERE id_leader = :id_leader";
    $stmt_leader = $db->prepare($sql_check_leader);
    $stmt_leader->bindParam(':id_leader', $id_leader, PDO::PARAM_INT);
    $stmt_leader->execute();

    if ($stmt_leader->rowCount() > 0) {
        die("Vous avez déjà créé une équipe.");
    }

    // Vérifier si le nom d'équipe est déjà pris
    $sql_check_nom = "SELECT * FROM Equipe WHERE nom_equipe = :nom_equipe";
    $stmt_nom = $db->prepare($sql_check_nom);
    $stmt_nom->bindParam(':nom_equipe', $nom_equipe, PDO::PARAM_STR);
    $stmt_nom->execute();

    if ($stmt_nom->rowCount() > 0) {
        die("Ce nom d'équipe est déjà utilisé. Veuillez en choisir un autre.");
    }

    // Insérer l'équipe si les conditions sont remplies
    $sql_insert = "INSERT INTO Equipe (nom_equipe, id_leader) VALUES (:nom_equipe, :id_leader)";
    $stmt_insert = $db->prepare($sql_insert);
    $stmt_insert->bindParam(':nom_equipe', $nom_equipe, PDO::PARAM_STR);
    $stmt_insert->bindParam(':id_leader', $id_leader, PDO::PARAM_INT);

    if ($stmt_insert->execute()) {
        // Récupérer l'ID de l'équipe nouvellement créée
        $id_equipe = $db->lastInsertId();

        // Mettre à jour l'utilisateur avec l'ID de l'équipe
        $sql_update_user = "UPDATE Utilisateur SET id_equipe = :id_equipe WHERE id_utilisateur = :id_utilisateur";
        $stmt_update_user = $db->prepare($sql_update_user);
        $stmt_update_user->bindParam(':id_equipe', $id_equipe, PDO::PARAM_INT);
        $stmt_update_user->bindParam(':id_utilisateur', $id_leader, PDO::PARAM_INT);

        if ($stmt_update_user->execute()) {
            echo "L'équipe a été créée et l'utilisateur mis à jour avec succès.";
        } else {
            echo "L'équipe a été créée, mais la mise à jour de l'utilisateur a échoué.";
        }
    } else {
        echo "Erreur lors de la création de l'équipe.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>
