<?php
// Headers de sécurité
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Content-Security-Policy: default-src 'self';");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure les fichiers nécessaires de PHPMailer
require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';

/*
    ********************************************************************************************
    CONFIGURATION
    ********************************************************************************************
*/
// Expéditeur
$config = require 'ds58f47r/config.php';
$email_expediteur = $config['EMAIL']; // Remplacez par votre email Gmail
$nom_expediteur = 'Contact Portfolio';

// Destinataire
$destinataire = $config['EMAIL']; // Adresse qui reçoit les emails

// Messages de confirmation
$message_envoye = "Votre message nous est bien parvenu !";
$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

// Messages d'erreur du formulaire
$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";

/*
    ********************************************************************************************
    FIN DE LA CONFIGURATION
    ********************************************************************************************
*/

// Vérifier si le formulaire a été soumis
if (isset($_POST['envoi'])) {
    function Rec($text)
    {
        return htmlspecialchars(trim($text), ENT_QUOTES);
    }

    function IsEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    if (!isset($_SESSION)) {
        session_start();
    }

    // Variable pour contrôler l'exécution de l'envoi
    $canSendEmail = true;

    if (isset($_SESSION['last_submit_time'])) {
        
        $delay = time() - $_SESSION['last_submit_time'];
        if ($delay < 60) { // 60 secondes entre chaque soumission
            $error_message = 'Veuillez attendre ' . (60 - $delay) . ' secondes avant d\'envoyer une nouvelle demande.';
            $canSendEmail = false;
        }
    }


    // Récupérer les champs du formulaire et vérifier qu'ils respectent les conditions
    $nom = isset($_POST['name']) ? Rec($_POST['name']) : '';
    $email = isset($_POST['email']) ? Rec($_POST['email']) : '';
    $objet = isset($_POST['object']) ? Rec($_POST['object']) : '';
    $message = isset($_POST['message']) ? Rec($_POST['message']) : '';

    if (strlen($nom) > 75 || strlen($objet) > 100 || strlen($message) > 3000) {
        $error_message = "Les champs dépassent les limites autorisées. (Nom : 75 car. | Objets : 100 car. | Message : 3000 car.)";
        $canSendEmail = false;
    }

    // Envoie du formulaire seulement si les conditions de sécurité sont confirmées
    if ($canSendEmail) {

        if (($nom != '') && ($email != '') && ($objet != '') && ($message != '')) {
            // Créer une instance de PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Configuration SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
                $mail->SMTPAuth = true;
                $mail->Username = $config['EMAIL']; // Votre adresse Gmail
                $mail->Password = $config['APP_KEY']; // Mot de passe Gmail ou clé d'application
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Protocole de chiffrement
                $mail->Port = 587; // Port sécurisé pour STARTTLS

                // Expéditeur et destinataire
                $nom_expediteur .= " ($nom)";
                $mail->setFrom($email_expediteur, $nom_expediteur);
                $mail->addAddress($destinataire);
                $mail->addReplyTo($email, $nom);

                // Contenu de l'e-mail
                $mail->isHTML(true);
                $objet .= ' (Exp. : ' . $email . ')';
                $mail->Subject = $objet;
                $mail->Body = nl2br($message);
                $mail->AltBody = strip_tags($message);

                // Envoyer l'e-mail
                $mail->send();
                $_SESSION['last_submit_time'] = time();
                $confirmation_message = $message_envoye;
            } catch (Exception $e) {
                $error_message = $message_non_envoye . ' Erreur : ' . $mail->ErrorInfo;
            }
        } else {
            $error_message = $message_formulaire_invalide;
        }
    }
}
?>

<?php require_once 'head.php'; ?>
<?php require_once 'nav_bar.php'; ?>

<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title">Canal de Communication</h2>
        <div class="contact-grid">
            <div class="contact-info">
                <div class="terminal-window">
                    <div class="terminal-header">
                        <span class="terminal-title">contact_info.sh</span>
                    </div>
                    <div class="terminal-content">
                        <p><span class="prompt">$</span> cat contact.txt</p>
                        <ul class="contact-list">
                            <li>
                                <i class="ri-mail-line"></i>
                                <span>dark.vador.obscur1@gmail.com</span>
                            </li>
                            <li>
                                <i class="ri-git-repository-line"></i>
                                <span>git.sithcode.empire/darkvador</span>
                            </li>
                            <li>
                                <i class="ri-discord-line"></i>
                                <span>@LordOfEncryption#1977</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <form class="contact-form" action="contact.php" method="POST">
                <div class="form-header">
                    <i class="ri-lock-line"></i>
                    <span>Canal sécurisé - Chiffrement DarkForce™</span>
                </div>
                <?php if (isset($error_message)): ?>
                    <div class="error-message">
                        <i class="ri-information-2-fill"></i>
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($confirmation_message)): ?>
                    <div class="confirmation-message">
                        <i class="ri-information-2-fill"></i>
                        <?php echo $confirmation_message; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group <?php echo isset($error_message) ? 'error' : ''; ?>">
                    <input type="text" placeholder="Identifiant système" name="name" required>
                </div>
                <div class="form-group <?php echo isset($error_message) ? 'error' : ''; ?>">
                    <input type="email" placeholder="Adresse de communication" name="email" required>
                </div>
                <div class="form-group <?php echo isset($error_message) ? 'error' : ''; ?>">
                    <input type="text" placeholder="Objet" name="object" required>
                </div>
                <div class="form-group <?php echo isset($error_message) ? 'error' : ''; ?>">
                    <textarea placeholder="Message crypté" name="message" required></textarea>
                </div>
                <button type="submit" name="envoi" class="btn imperial-btn">
                    <i class="ri-send-plane-line"></i>
                    Transmission sécurisée
                </button>
            </form>
        </div>
    </div>
</section>


<?php require_once 'footer.php'; ?>