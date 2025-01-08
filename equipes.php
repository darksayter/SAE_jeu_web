<?php 
include 'header.php';
session_start();
include 'controllers/connexion_bdd.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    die("Vous devez être connecté pour accéder à cette page.");
}

$id_utilisateur = $_SESSION['id_utilisateur'];

// Récupérer l'équipe de l'utilisateur à partir de la table Utilisateurs
$sql_user_team = "SELECT e.* FROM Equipe e
                  INNER JOIN Utilisateur u ON e.id_equipe = u.id_equipe
                  WHERE u.id_utilisateur = :id_utilisateur";
$stmt_user_team = $db->prepare($sql_user_team);
$stmt_user_team->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
$stmt_user_team->execute();
$equipe = $stmt_user_team->fetch(PDO::FETCH_ASSOC);

// Si l'utilisateur n'a pas d'équipe, récupérer toutes les équipes disponibles
if (!$equipe) {
    $sql_all_teams = "SELECT * FROM Equipe";
    $stmt_all_teams = $db->prepare($sql_all_teams);
    $stmt_all_teams->execute();
    $all_equipes = $stmt_all_teams->fetchAll(PDO::FETCH_ASSOC);
}

$sql_all_teams = "SELECT e.*, u.nom_utilisateur AS nom_leader 
                  FROM Equipe e 
                  LEFT JOIN Utilisateur u ON e.id_leader = u.id_utilisateur";
$stmt_all_teams = $db->prepare($sql_all_teams);
$stmt_all_teams->execute();
$all_equipes = $stmt_all_teams->fetchAll(PDO::FETCH_ASSOC);

?>

<html>
<head>
      <style>
     
      .team-info-container {
          text-align: center;
          margin: 20px auto;
          width: 60%;
          background-color: #2e2e4a;
          border-radius: 15px;
          padding: 20px;
          color: #fff;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      }

      .team-info-card {
          background-color: #3a3a55;
          border-radius: 10px;
          padding: 15px;
          margin: 10px 0;
          color: #d1d1e0;
      }

      .team-info-card p {
          margin: 10px 0;
          font-size : 30px;
          
      }

      .leave-button {
          padding: 10px 20px;
          background-color: #d9534f;
          color: white;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          font-size: 40px;
      }

      .leave-button:hover {
          background-color: #c9302c;
      }

      h2 {
          color: #fff;
          font-size: 45px;
      }
      
      .table-container {
        margin: 20px auto;
        width: 80%;
        border-radius: 15px;
        overflow: hidden;
        background-color: #3a3a55;
        padding: 20px;
      }
      
      table {
        width: 100%;
        border-collapse: collapse;
      }
      
      table th, table td {
        padding: 10px;
        text-align: center;
        border: 1px solid #4a4a6a;
        font-size : 30px;
      }
      
      table th {
        background-color: #2e2e4a;
        color: #ffffff;
      }
      
      table td {
        color: #d1d1e0;
      }
      
      .join-button {
        padding: 5px 10px;
        background-color: #5c85d6;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
      
      .join-button:hover {
      	background-color: #3b5cad;
      }
    </style>
</head>
<body>

<div class="container" style="text-align:center;">
    <span id="text"></span><span class="cursor">_</span>
</div>
<script src="assets/JAVASCRIPT/ecriture_equipes.js"></script>

<br><br><br><br><br>
<div class="team-info-container">
  	<?php if ($equipe): ?>
    <h2>Votre Équipe</h2>
    <div class="team-info-card">
        <p><strong>Nom de l'équipe :</strong> <?= htmlspecialchars($equipe['nom_equipe']) ?></p>
        <p><strong>ID de l'équipe :</strong> <?= $equipe['id_equipe'] ?></p>
        <p><strong>Nom du leader :</strong> <?= htmlspecialchars($equipe['nom_leader'] ?? 'Non défini') ?></p>
        
        <!-- Formulaire pour quitter l'équipe -->
        <form action="controllers/quitter_equipe.php" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir quitter cette équipe ?');"><br>
            <input type="hidden" name="id_equipe" value="<?= $equipe['id_equipe'] ?>">
            <button type="submit" class="leave-button">Quitter l'équipe</button>
        </form>
    </div>
</div>

    <?php else: ?>
        <h2>Équipes disponibles</h2>
        <?php if ($all_equipes): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nom équipe</th>
                        <th> Nom du leader </th>
                        <th>Rejoindre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_equipes as $equipe): ?>
                        <tr>
                            <td><?= htmlspecialchars($equipe['nom_equipe']) ?></td>
                            <td><?= htmlspecialchars($equipe['nom_leader'] ?? 'Non défini') ?></td>
                            <td>
                                <form action="controllers/rejoindre_equipes.php" method="POST">
                                    <input type="hidden" name="id_equipe" value="<?= $equipe['id_equipe'] ?>">
                                    <button type="submit" class="join-button">Rejoindre</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune équipe n'a encore été créée.</p>
        <?php endif; ?>

        <h2>Créer une équipe</h2>
        <form action="controllers/creation_equipe.php" method="POST">
            <label for="nom_equipe">Nom de l'équipe :</label>
            <input type="text" id="nom_equipe" name="nom_equipe" required><br><br>
                        
            <input type="submit" value="Créer l'équipe">
        </form>
    <?php endif; ?>
</div>

<br><br><br><br><br><br><br><br><br>
<?php include 'footer.php'; ?>
</body>
</html>
