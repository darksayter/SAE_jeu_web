<?php
include 'header.php';
session_start();

// Inclure le fichier de connexion à la base de données
include 'controllers/connexion_bdd.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id_utilisateur'])) {
    $id_utilisateur = $_SESSION['id_utilisateur'];

    try {
        $con = new PDO($dsn);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer l'utilisateur connecté
        $stmt = $con->prepare("SELECT * FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Récupérer les scores globaux par équipe
        $query = "
            SELECT 
                e.id_equipe, 
                e.nom_equipe, 
                u.avatar AS avatar_leader, 
                SUM(nc.score) AS score_total
            FROM 
                Equipe e
            LEFT JOIN 
                Utilisateur u ON e.id_leader = u.id_utilisateur
            LEFT JOIN 
                niveaucomplete nc ON u.id_utilisateur = nc.id_utilisateur
            GROUP BY 
                e.id_equipe, e.nom_equipe, u.avatar
            ORDER BY 
                score_total DESC, e.nom_equipe
        ";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $classement_equipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Trouver la position de l'équipe de l'utilisateur
        $user_team_position = null;
        foreach ($classement_equipes as $index => $team) {
            if ($team['id_equipe'] == $user['id_equipe']) {
                $user_team_position = $index + 1;
                break;
            }
        }

        // Récupérer les scores individuels des utilisateurs
        $query = "
            SELECT 
                u.id_utilisateur, 
                u.nom_utilisateur, 
                u.avatar, 
                COALESCE(SUM(nc.score), 0) AS score_total
            FROM 
                Utilisateur u
            LEFT JOIN 
                niveaucomplete nc ON u.id_utilisateur = nc.id_utilisateur
            GROUP BY 
                u.id_utilisateur, u.nom_utilisateur, u.avatar
            ORDER BY 
                score_total DESC, u.nom_utilisateur
        ";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $classement_utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Trouver la position de l'utilisateur dans le classement des utilisateurs
        $user_position = null;
        foreach ($classement_utilisateurs as $index => $utilisateur) {
            if ($utilisateur['id_utilisateur'] == $id_utilisateur) {
                $user_position = $index + 1;
                break;
            }
        }

    } catch (PDOException $e) {
        echo 'Erreur de connexion : ' . $e->getMessage();
        exit(0);
    }
} else {
    echo "Utilisateur non connecté.";
    exit(0);
}
?>

<!-- BODY -->
<body class="body">
    <div class="content">
        <!-- TITRE -->
        <br><br>
        <div class="container">
            <span id="text"></span><span class="cursor">_</span>
        </div>
        <script src="assets/JAVASCRIPT/ecriture_classement.js"></script>

        <!-- Description -->
        <p class="description"> 
            Retrouvez ci-dessous les top 3 dans le classement et retrouvez également votre position dans le classement 
            <br> avec le nombre de points que vous possédez ainsi que les autres équipes. 
            <br> Alors ne vous laissez pas abattre et prouvez que vous méritez la première place !
        </p>

        <h1>Classement equipes : </h1>
        <br>
        <h3> Le top 3 des équipes </h3>
        <!-- Classement sous forme de podium -->
        <div class="podium">
            <?php
            for ($i = 0; $i < 3; $i++) {
                if (isset($classement_equipes[$i])) {
                    $classe = ($i == 0) ? "first" : (($i == 1) ? "second" : "third");
                    echo '<div class="podium-item ' . $classe . '">';
                    echo '<div class="profile-pic">';
                    $avatar = $classement_equipes[$i]['avatar_leader'] ?: './assets/IMAGES/default_avatar.png';
                    echo '<img src="' . htmlspecialchars($avatar) . '" alt="Équipe ' . htmlspecialchars($classement_equipes[$i]['nom_equipe']) . '">';
                    echo '</div>';
                    echo '<div class="username">' . htmlspecialchars($classement_equipes[$i]['nom_equipe']) . '</div><br>';
                    echo '<div class="username"> Score : ' . htmlspecialchars($classement_equipes[$i]['score_total']) . '</div><br>';
                    echo '<div class="podium-step">' . ($i + 1) . '</div><br>';
                    echo '</div>';
                }
            }
            ?>
        </div>

        <br><br>
        <h3>Votre position dans le classement des équipes :</h3>
        <div class="user-ranking">
            <div class="user-rank">
                <div class="profile-pic">
                    <img src="<?php echo $user['avatar']; ?>" alt="Utilisateur connecté">
                </div>
                <div class="username"><?= htmlspecialchars($user['id_equipe'] ? $classement_equipes[$user_team_position - 1]['nom_equipe'] : 'Sans équipe') ?></div>
                <div class="user-step">Position : <?= htmlspecialchars($user_team_position ?? 'Non classé') ?></div>
            </div>
        </div>

        <br><br>

        <h3>Classement général des équipes :</h3>
		<div class="other-participants">
    		<ul>
        		<?php foreach ($classement_equipes as $index => $team): ?>
            		<li>
                		<div class="other-participants-under">
                    		<div class="other-participants-step"><?= $index + 1 ?></div>
                    		<div class="username"><?= htmlspecialchars($team['nom_equipe']) ?> - Score : <?= htmlspecialchars($team['score_total']) ?></div>
                		</div>
            		</li>
        		<?php endforeach; ?>
    		</ul>
		</div>
		<br>



        <h1>Classement utilisateurs : </h1>
		<br>
        <h3> Le top 3 des utilisateurs </h3>
        <!-- Classement sous forme de podium -->
        <div class="podium">
            <?php
            for ($i = 0; $i < 3; $i++) {
                if (isset($classement_utilisateurs[$i])) {
                    $classe = ($i == 0) ? "first" : (($i == 1) ? "second" : "third");
                    echo '<div class="podium-item ' . $classe . '">';
                    echo '<div class="profile-pic">';
                    $avatar = $classement_utilisateurs[$i]['avatar'] ?: './assets/IMAGES/default_avatar.png';
                    echo '<img src="' . htmlspecialchars($avatar) . '" alt="Utilisateur ' . htmlspecialchars($classement_utilisateurs[$i]['nom_utilisateur']) . '">';
                    echo '</div>';
                    echo '<div class="username">' . htmlspecialchars($classement_utilisateurs[$i]['nom_utilisateur']) . '</div><br>';
                    echo '<div class="username"> Score : ' . htmlspecialchars($classement_utilisateurs[$i]['score_total']) . '</div><br>';
                    echo '<div class="podium-step">' . ($i + 1) . '</div><br>';
                    echo '</div>';
                }
            }
            ?>
        </div>

        <br><br>
		<h3>Votre position dans le classement des utilisateurs :</h3>
		<div class="user-ranking">
    		<div class="user-rank">
       			<div class="profile-pic">
            		<img src="<?php echo $user['avatar']; ?>" alt="Utilisateur connecté">
        		</div>
        		<div class="username"><?= htmlspecialchars($user['nom_utilisateur']) ?></div>
        		<div class="user-step">Position : <?= htmlspecialchars($user_position ?? 'Non classé') ?></div>
    		</div>
		</div>


        <br>
        <h3>Classement général des utilisateurs :</h3>
        <div class="other-participants">
            <ul>
                <?php foreach ($classement_utilisateurs as $index => $utilisateur): ?>
                    <li>
                        <div class="other-participants-under">
                            <div class="other-participants-step"><?= $index + 1 ?></div>
                            <div class="username"><?= htmlspecialchars($utilisateur['nom_utilisateur']) ?></div>
                            <div class="username">Score : <?= htmlspecialchars($utilisateur['score_total']) ?></div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <br>

    </div>
</body>

<?php
include 'footer.php';
?>
</html>
