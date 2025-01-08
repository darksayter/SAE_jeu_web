<?php
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

// Informations de l'e-mail
$to = 'clementduchemin6@gmail.com'; // Remplace par ton adresse e-mail
$subject = 'Votre code aléatoire';
$message = "Bonjour,\n\nVoici votre code aléatoire : $randomCode\n\nCordialement,\nL'équipe.";
$headers = 'From: noreply@example.com' . "\r\n" .
           'Reply-To: noreply@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

// Envoi de l'e-mail
if (mail($to, $subject, $message, $headers)) {
    echo "E-mail envoyé avec succès !";
} else {
    echo "Une erreur est survenue lors de l'envoi de l'e-mail.";
}
?>
