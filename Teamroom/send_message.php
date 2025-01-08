<?php
$host = "database"; 
$dbname = "sae-jeu-web";
$user = "sae-jeu-web";
$password = "O289QDLFJ4qN";
$dsn = "mysql:host=$host;dbname=$dbname;user=$user;password=$password";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données POST
    $sender_id = $_POST['sender_id'] ?? null;
    $team_id = $_POST['team_id'] ?? null;
    $message = $_POST['message'] ?? null;

    if (!$sender_id || !$team_id || !$message) {
        echo json_encode(['success' => false, 'error' => 'Données manquantes']);
        exit;
    }

    // Connexion à la base de données
    try {
        $con = new PDO($dsn);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête d'insertion
        $stmt = $con->prepare('INSERT INTO Message (id_utilisateur, id_equipe, texte) VALUES (?,?,?)');
        $stmt->execute([$sender_id, $team_id, $message]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Erreur de connexion : ' . $e->getMessage()]);
    }
}

?>
