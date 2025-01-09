<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['envoi'])) {
    // Connection à la base de données
    require 'functions/db_operations.php';
    $pdo = connection_db();

    // Traite les erreurs potentielles lors de l'ouverture de la bdd
    if ($pdo[0] === false) {
        die($pdo[1]);
    } else {
        $pdo = $pdo[1];
    }

    $login = verify_login($pdo, $_POST['email'], $_POST['password']);

    if ($login !== null) {
        session_start();
        $_SESSION['id'] = $login;
        header('Location: dashboard.php');
        exit();
    } else {
        $error_message = 'Identifiants incorrects';
    }
}

require_once 'functions/auth.php';
redirect();
?> 

<?php require_once 'head.php'; ?>
<?php require_once 'nav_bar.php'; ?>

<section id="contact" class="contact-section">
    <div class="container">
        <h2 class="section-title">Page de connexion</h2>
        <div class="login-grid">
            <form class="contact-form" method="POST" action="login.php">
                <?php if (isset($error_message)): ?>
                    <div class="error-message">
                        <i class="ri-information-2-fill"></i>
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <div class="form-group <?php echo isset($error_message) ? 'error' : ''; ?>">
                        <input type="email" placeholder="Adresse mail" name="email" required>
                    </div>
                    <div class="form-group <?php echo isset($error_message) ? 'error' : ''; ?>">
                        <input type="password" placeholder="Mot de passe" name="password" required>
                    </div>
                </div>
                <div>
                    <button class="btn imperial-btn" type="submit" name="envoi" value="1">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
