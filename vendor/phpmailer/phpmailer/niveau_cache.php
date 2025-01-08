<?php
// Inclure les fichiers nécessaires depuis le dossier PHPMailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\phpmailer;
use PHPMailer\PHPMailer\Exception;

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

// Générer un code aléatoire
$randomCode = generateRandomCode();

// Configuration de l'e-mail avec PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';            // Serveur SMTP (par exemple, Gmail)
    $mail->SMTPAuth   = true;                        // Activer l'authentification SMTP
    $mail->Username   = 'askey.sae.web@gmail.com'; // Ton e-mail
    $mail->Password   = 'udlq brlj vmma cndy';           // Ton mot de passe ou mot de passe d'application
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Chiffrement TLS
    $mail->Port       = 587;                         // Port SMTP

    // Configuration des destinataires et de l'expéditeur
    $mail->setFrom('askey.sae.web@gmail.com', 'site askey');
    $mail->addAddress('clementduchemin6@gmail.com'); // Destinataire

    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Votre code aléatoire';
    $mail->Body    = "<p>Bonjour,</p><p>Voici votre code aléatoire : <strong>$randomCode</strong></p><p>Cordialement,<br>L'équipe.</p>";
    $mail->AltBody = "Bonjour,\n\nVoici votre code aléatoire : $randomCode\n\nCordialement,\nL'équipe.";

    // Envoyer l'e-mail
    $mail->send();
    echo 'E-mail envoyé avec succès !';
} catch (Exception $e) {
    echo "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
}
?>
