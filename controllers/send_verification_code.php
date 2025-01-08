<?php
// Inclure les fichiers nécessaires depuis PHPMailer
require '../vendor/phpmailer/phpmailer/phpmailer/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/phpmailer/SMTP.php';
require '../vendor/phpmailer/phpmailer/phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Générer un code de vérification aléatoire
function generateVerificationCode() {
    return rand(100000, 999999); // Code à 6 chiffres
}

// Si on reçoit un email via POST
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $verificationCode = generateVerificationCode();

    // Configuration de l'e-mail avec PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'askey.sae.web@gmail.com';
        $mail->Password   = 'udlq brlj vmma cndy';  // Ton mot de passe ou mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinataire
        $mail->setFrom('askey.sae.web@gmail.com', 'Service d\'Inscription');
        $mail->addAddress($email);

        // Sujet et contenu de l'e-mail
        $mail->Subject = 'Code de vérification pour votre inscription';
        $mail->Body    = 'Voici votre code de vérification : ' . $verificationCode;

        // Envoi de l'e-mail
        $mail->send();

        // Retourner le code de vérification comme réponse
        echo $verificationCode;
    } catch (Exception $e) {
        echo 'Erreur lors de l\'envoi du code: ', $mail->ErrorInfo;
    }
}
?>
