<?php
session_start();

if (!isset($_SESSION['id_utilisateur'])) {
    die("Vous devez être connecté pour compléter un chapitre.");
}

$id_utilisateur = $_SESSION['id_utilisateur'];
$id_chapitre = 1; // ID du chapitre actuel, vous pouvez le définir dynamiquement selon votre logique

include '../../../controllers/connexion_bdd.php';

// Initialisation des réponses correctes
$correct_answers = [
    "question1" => "u",
    "question2" => "14641",
    "question3" => "31415",
    "question4" => "bravo"
];

// Compteur d'erreurs
$errors = 0;

// Récupérer les réponses soumises
$user_answers = [
    "question1" => $_POST['question1'] ?? '',
    "question2" => $_POST['question2'] ?? '',
    "question3" => $_POST['question3'] ?? '',
    "question4" => $_POST['question4'] ?? ''
];

// Vérification des réponses
foreach ($correct_answers as $key => $correct) {
    if (strtolower(trim($user_answers[$key])) !== strtolower(trim($correct))) {
        $errors++;
    }
}

// Redirection selon le résultat
if ($errors == 0) {
    echo "<script>alert('Félicitations ! Toutes les réponses sont correctes.'); window.location.href = '../selection_niveaux1.php';</script>";
    try {
        $con = new PDO($dsn);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête de mise à jour
        $stmt = $con->prepare('INSERT INTO niveaucomplete (id_utilisateur, id_niveau, score, num_chap) VALUES (:id_user, 3, 500, 1)');
        $stmt->bindParam(':id_user', $id_user);

        // Exécuter la requête
        $stmt->execute();

        // Préparer la requête d'insertion pour enregistrer la complétion du chapitre
        $stmt = $con->prepare('INSERT INTO chapitrecomplete (id_utilisateur, id_chapitre) VALUES (:id_utilisateur, :id_chapitre)');
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->bindParam(':id_chapitre', $id_chapitre, PDO::PARAM_INT);

        // Exécuter la requête
        $stmt->execute();

        // Débloquer le niveau bonus
        $stmt = $con->prepare('UPDATE Utilisateur SET deblocage_finale = 1 WHERE id_utilisateur = :id_utilisateur');
        $stmt->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);

        // Exécuter la requête
        $stmt->execute();

        
    } catch (PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
    }
} else {
    echo "<script>alert('Vous avez $errors erreur(s). Essayez encore !'); window.location.href = 'Niveaux3.php';</script>";
}
?>
