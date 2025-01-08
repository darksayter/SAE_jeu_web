<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Charger l'autoloader de Composer
require '../vendor/phpmailer/phpmailer/phpmailer/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/phpmailer/SMTP.php';
require '../vendor/phpmailer/phpmailer/phpmailer/Exception.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $avatar = $_POST['avatar'];

    // Fonction pour valider le mot de passe
    function validate_password($password) {
        return preg_match('/^(?=.*[A-Z])(?=.*\\W).{8,}$/', $password);
    }

    // Valider les données
    if (!empty($nom_utilisateur) && !empty($email) && !empty($mdp) && !empty($avatar)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (validate_password($mdp)) {
                // Hachage du mot de passe
                $mdp_hash = password_hash($mdp, PASSWORD_BCRYPT);

                // Inclure le fichier de connexion à la base de données
                include 'connexion_bdd.php';

                try {
                    $con = new PDO($dsn);
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Vérifier si le nom d'utilisateur ou l'email existe déjà
                    $stmt_check = $con->prepare("SELECT * FROM Utilisateur WHERE nom_utilisateur = :nom_utilisateur OR mail = :mail");
                    $stmt_check->bindParam(':nom_utilisateur', $nom_utilisateur);
                    $stmt_check->bindParam(':mail', $email);
                    $stmt_check->execute();

                    $existing_user = $stmt_check->fetch(PDO::FETCH_ASSOC);

                    if ($existing_user) {
                        // Si l'utilisateur existe déjà mais n'est pas activé
                        if ($existing_user['active'] == 0) {
                            // Générer un nouveau code de vérification
                            $verification_code = generateRandomCode();

                            // Mettre à jour le code de vérification
                            $stmt_update = $con->prepare("UPDATE Utilisateur SET verification_code = :verification_code WHERE mail = :mail");
                            $stmt_update->bindParam(':mail', $email);
                            $stmt_update->bindParam(':verification_code', $verification_code);
                            $stmt_update->execute();

                            // Envoi de l'email avec le nouveau code de vérification
                            sendVerificationEmail($email, $verification_code);

                            // Rediriger vers la page de vérification
                            header('Location: ./verifier_code.php'); // Page pour entrer l'email et le code
                            exit(0);
                        } else {
                            echo "Le compte est déjà activé. Vous pouvez vous connecter.";
                        }
                    } else {
                        // Si l'utilisateur n'existe pas, inscription normale
                        $verification_code = generateRandomCode();

                        // Insérer l'utilisateur dans la base de données avec le code de vérification
                        $stmt_insert = $con->prepare("INSERT INTO Utilisateur (nom_utilisateur, mail, mdp, avatar, verification_code, active) VALUES (:nom_utilisateur, :mail, :mdp, :avatar, :verification_code, 0)");
                        $stmt_insert->bindParam(':nom_utilisateur', $nom_utilisateur);
                        $stmt_insert->bindParam(':mail', $email);
                        $stmt_insert->bindParam(':mdp', $mdp_hash);
                        $stmt_insert->bindParam(':avatar', $avatar);
                        $stmt_insert->bindParam(':verification_code', $verification_code);
                        $stmt_insert->execute();

                        // Envoi de l'email avec le code de vérification
                        sendVerificationEmail($email, $verification_code);

                        // Rediriger vers la page de vérification
                        header('Location: verifier_code.php'); // Page pour entrer l'email et le code
                        exit(0);
                    }
                } catch (PDOException $e) {
                    echo 'Erreur de connexion : ' . $e->getMessage();
                    exit(0);
                }
            } else {
                echo "Le mot de passe doit contenir au moins 8 caractères, une majuscule et un caractère spécial.";
            }
        } else {
            echo "Veuillez entrer une adresse e-mail valide.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
} else {
    echo "Méthode de requête non autorisée.";
}

// Fonction pour générer un code aléatoire
function generateRandomCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomCode = '';
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomCode;
}

// Fonction pour envoyer un email de vérification
function sendVerificationEmail($email, $verification_code) {
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';            // Serveur SMTP (par exemple, Gmail)
        $mail->SMTPAuth   = true;                        // Activer l'authentification SMTP
        $mail->Username   = 'askey.sae.web@gmail.com';   // Ton e-mail
        $mail->Password   = 'udlq brlj vmma cndy';       // Ton mot de passe ou mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Chiffrement TLS
        $mail->Port       = 587;                         // Port SMTP

        // Configuration des destinataires et de l'expéditeur
        $mail->setFrom('askey.sae.web@gmail.com', 'site askey');
        $mail->addAddress($email); // Destinataire

        // Contenu de l'e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Vérification de votre email';
        $mail->Body    = "<p>Bonjour,</p><p>Voici votre code de vérification : <strong>$verification_code</strong></p><p>Cordialement,<br>L'équipe.</p>";
        $mail->AltBody = "Bonjour,\n\nVoici votre code de vérification : $verification_code\n\nCordialement,\nL'équipe.";

        // Envoyer l'e-mail
        $mail->send();
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
    }
}
?>
