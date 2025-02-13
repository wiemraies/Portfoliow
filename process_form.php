<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer et sécuriser les données du formulaire
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validation des champs
    if (empty($name) || empty($email) || empty($message)) {
        echo "Veuillez remplir tous les champs.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse e-mail invalide.";
        exit;
    }

    // Paramètres de l'e-mail
    $to = "raiswiem18@gmail.com"; // Remplacez par votre adresse e-mail
    $subject = "Nouveau message de $name depuis le portfolio";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Nom: $name\nE-mail: $email\n\nMessage:\n$message";

    // Envoi de l'e-mail et redirection
    if (mail($to, $subject, $body, $headers)) {
        header("Location: thank_you.html"); // Redirige vers la page de remerciement
        exit;
    } else {
        echo "Une erreur s'est produite, veuillez réessayer.";
    }
}
?>
