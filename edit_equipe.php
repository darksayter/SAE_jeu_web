<?php
session_start();

include 'controllers/connexion_bdd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_equipe = $_POST['id_equipe'];
    $nom_equipe = $_POST['nom_equipe'];
    $id_leader = $_POST['id_leader'];

    try {
        $con = new PDO($dsn);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $con->prepare("UPDATE Equipe SET nom_equipe = :nom_equipe, id_leader = :id_leader WHERE id_equipe = :id_equipe");
        $stmt->bindParam(':id_equipe', $id_equipe);
        $stmt->bindParam(':nom_equipe', $nom_equipe);
        $stmt->bindParam(':id_leader', $id_leader);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>