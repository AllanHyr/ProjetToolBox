<?php

$to = "allan.bouguerab@gmail.com";
$subject = "Test d\'envoi de mail";
$message = "Ceci est un test d\'envoi de mail via PHP.";

$headers = "Content-Type: text/plain; charset=utf-8\r\n";
$headers .= "From: mytoolbox769@gmail.com\r\n";

if(mail($to, $subject, $message, $headers)) {
    echo 'Le message a été envoyé avec succès.';
} else {
    echo 'Une erreur est survenue lors de l\'envoi du message.';
}
?>
