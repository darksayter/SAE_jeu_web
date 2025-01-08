<?php
session_start();

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['id_utilisateur']) || $_SESSION['admin'] == 1) {
    header('Location: login.php');
    exit(0);
}

include 'header.php';
include 'controllers/connexion_bdd.php';

try {
    $con = new PDO($dsn);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparer la requête pour récupérer les informations des utilisateurs
    $stmt = $con->prepare("SELECT id_equipe, nom_equipe, id_leader FROM Equipe");
    
    // Exécuter la requête
    $stmt->execute();

    // Récupérer les informations des utilisateurs
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Equipes</title>
</head>
<body>
    <div class="content">
        <h1 class="main-title">Gestion des Equipes</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>Id Equipe</th>
                <th>Nom Equipe</th>
                <th>Leader</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user['id_equipe']; ?></td>
                    <td><?php echo $user['nom_equipe']; ?></td>
                    <td><?php echo $user['id_leader']; ?></td>
                    <td>
                        <button class="edit-btn" data-id="<?php echo $user['id_equipe']; ?>" data-nom="<?php echo $user['nom_equipe']; ?>" data-leader="<?php echo $user['id_leader']; ?>">Edit</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>

    <div id="editEquipeModal" style="display:none;">
        <form id="editEquipeForm">
            <input type="hidden" name="id_equipe" id="id_equipe">
            <label for="nom_equipe">Nom Equipe:</label>
            <input type="text" name="nom_equipe" id="nom_equipe">
            <label for="id_leader">Leader:</label>
            <input type="text" name="id_leader" id="id_leader">
            <button type="submit">Modifier</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var idEquipe = this.dataset.id;
                    var nomEquipe = this.dataset.nom;
                    var idLeader = this.dataset.leader;

                    document.getElementById('id_equipe').value = idEquipe;
                    document.getElementById('nom_equipe').value = nomEquipe;
                    document.getElementById('id_leader').value = idLeader;

                    document.getElementById('editEquipeModal').style.display = 'block';
                });
            });

            document.getElementById('editEquipeForm').addEventListener('submit', function(event) {
                event.preventDefault();

                var formData = new FormData(this);

                fetch('edit_equipe.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Equipe modifiée avec succès');
                        location.reload();
                    } else {
                        alert('Erreur lors de la modification de l\'équipe');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>