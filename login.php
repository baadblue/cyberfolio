<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['envoi'])) {
    if (($_POST['id'] === 'jesuistonpère') && ($_POST['password'] === 'non')) {
        session_start();
        $_SESSION['id'] = 123;
        $_SESSION['status'] = 'admin';
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
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <div class="form-group <?php echo isset($error_message) ? 'error' : ''; ?>">
                        <input type="text" placeholder="Identifiant" name="id" required>
                    </div>
                    <div class="form-group <?php echo isset($error_message) ? 'error' : ''; ?>">
                        <input type="password" placeholder="Mot de passe" name="password" required>
                    </div>
                </div>
                <div>
                    <button class="btn imperial-btn" type="submit" name="envoi">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once 'footer.php' ?>