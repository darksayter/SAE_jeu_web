<?php
session_start();

if (!empty($_POST['password']) && !empty($_POST['username'])) {
    $username = $_POST['username'];
    $passwords = $_POST['password'];

    include 'connexion_bdd.php';

    try {
        $con = new PDO($dsn);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête pour récupérer les informations de l'utilisateur
        $stmt = $con->prepare("SELECT * FROM Utilisateur WHERE nom_utilisateur = :username");
        $stmt->bindParam(':username', $username);
        
        // Exécuter la requête
        $stmt->execute();

        // Vérifier si une correspondance a été trouvée
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($passwords, $user['mdp'])) {
            // Correspondance trouvée, créer une variable de session
            $_SESSION['id_utilisateur'] = $user['id_utilisateur'];

            // Vérifier si l'utilisateur est un administrateur
            if ($user['admin'] == 1) {
                header('Location: ../admin.php');
            } else {
                header('Location: ../index.php');
            }
            exit(0);
        } else {
            // Pas de correspondance trouvée, rediriger vers la page de connexion
            echo "Nom d'utilisateur ou mot de passe incorrect.";
            ?>
            <form action="../login.php">
                <input type="submit" value="Retour">
            </form>
            <?php
        }
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit(0);
    }
} else {
    echo "Veuillez entrer un nom d'utilisateur et un mot de passe."; ?>
    <form action="../login.php">
        <input type="submit" value="Retour">
    </form>
<?php } ?>