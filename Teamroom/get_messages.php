<?php
session_start();  // Assurez-vous que cette ligne est bien présente en haut du fichier PHP

$host = "database"; 
$dbname = "sae-jeu-web";
$user = "sae-jeu-web";
$password = "O289QDLFJ4qN";
$dsn = "mysql:host=$host;dbname=$dbname;user=$user;password=$password";

try {
    $con = new PDO($dsn);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $id_utilisateur = $_SESSION['id_utilisateur'];
  
        $stmt = $con->prepare("SELECT id_equipe FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();

        // Récupérer l'ID de l'équipe
        $id_equipe = $stmt->fetch(PDO::FETCH_ASSOC);
  
        if (!$id_equipe) {
            echo json_encode(['success' => false, 'error' => 'ID de l\'équipe non défini']);
            exit;
        }

        // Utiliser l'ID de l'équipe récupéré
        $id_equipe = $id_equipe['id_equipe'];
        
        // Récupérer les messages
        $stmt = $con->prepare("SELECT u.nom_utilisateur AS sender, m.texte AS content, m.timestamp as temps
                               FROM Message m
                               JOIN Utilisateur u ON m.id_utilisateur = u.id_utilisateur
                               WHERE m.id_equipe = :team_id
                               ORDER BY m.timestamp ASC");
        $stmt->bindParam(':team_id', $id_equipe, PDO::PARAM_INT);
        $stmt->execute();

        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
        if (empty($messages)) {
            echo json_encode(['success' => false, 'error' => 'Aucun message trouvé']);
        } else {
            echo json_encode($messages);
        }

    }
} catch (\Throwable $th) {
    echo json_encode(['success' => false, 'error' => $th->getMessage()]);
    exit;
}

    
?>
