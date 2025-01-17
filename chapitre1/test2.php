<?php
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
if ($errors === 0) {
    echo "<script>alert('Félicitations ! Toutes les réponses sont correctes.'); window.location.href = 'test.php';</script>";
} else {
    echo "<script>alert('Vous avez $errors erreur(s). Essayez encore !'); window.location.href = 'test.php';</script>";
}
?>
