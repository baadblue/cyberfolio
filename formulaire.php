<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure les fichiers nécessaires de PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

/*
    ********************************************************************************************
    CONFIGURATION
    ********************************************************************************************
*/
// Expéditeur
$email_expediteur = 'mail'; // Remplacez par votre email Gmail
$nom_expediteur = 'Contact Monsite.com';

// Destinataire
$destinataire = 'mail'; // Adresse qui reçoit les emails

// Messages de confirmation
$message_envoye = "Votre message nous est bien parvenu !";
$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

// Messages d'erreur du formulaire
$message_erreur_formulaire = "Vous devez d'abord <a href=\"contact.html\">envoyer le formulaire</a>.";
$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";

/*
    ********************************************************************************************
    FIN DE LA CONFIGURATION
    ********************************************************************************************
*/

// Vérifier si le formulaire a été soumis
if (!isset($_POST['envoi'])) {
    echo '<p>' . $message_erreur_formulaire . '</p>' . "\n";
} else {
    function Rec($text)
    {
        return htmlspecialchars(trim($text), ENT_QUOTES);
    }

    function IsEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Récupérer les champs du formulaire
    $nom = isset($_POST['id']) ? Rec($_POST['id']) : '';
    $email = isset($_POST['email']) ? Rec($_POST['email']) : '';
    $objet = isset($_POST['niveau']) ? Rec($_POST['niveau']) : '';
    $message = isset($_POST['message']) ? Rec($_POST['message']) : '';

    if (($nom != '') && ($email != '') && ($objet != '') && ($message != '')) {
        // Créer une instance de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuration SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'mail'; // Votre adresse Gmail
            $mail->Password = 'cle d\'application'; // Mot de passe Gmail ou clé d'application
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Protocole de chiffrement
            $mail->Port = 587; // Port sécurisé pour STARTTLS

            // Expéditeur et destinataire
            $mail->setFrom($email_expediteur, $nom_expediteur);
            $mail->addAddress($destinataire);
            $mail->addReplyTo($email, $nom);

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = $objet;
            $mail->Body = nl2br($message);
            $mail->AltBody = strip_tags($message);

            // Envoyer l'e-mail
            $mail->send();
            echo '<p>' . $message_envoye . '</p>';
        } catch (Exception $e) {
            echo '<p>' . $message_non_envoye . ' Erreur : ' . $mail->ErrorInfo . '</p>';
        }
    } else {
        echo '<p>' . $message_formulaire_invalide . ' <a href="contact.html">Retour au formulaire</a></p>' . "\n";
    }
}
?>
