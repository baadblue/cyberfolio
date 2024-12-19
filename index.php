<?php require_once 'head.php'; ?>
<?php require_once 'nav_bar.php'; ?>

<?php
require 'functions/db_operations.php';
$pdo = connection_db();

// Traite les erreurs potentielles lors de l'ouverture de la bdd
if ($pdo[0] === false) {
    die($pdo[1]);
} else {
    $pdo = $pdo[1];
}
$info = recover_user_info($pdo, 1);
$firstname = $info['firstname'];
$lastname = $info['lastname'];

?>

<section id="accueil" class="hero-section">
    <div class="tech-decoration top-left"></div>
    <div class="hero-content">
        <h1><?php echo $firstname . ' ' . $lastname; ?></h1>
        <h2 class="tech-title">Architecte des Défenses Impériales</h2>
        <p class="tagline">"La sécurité n'est pas une option. C'est une question de survie."</p>
        <div class="hero-cta">
            <button class="btn imperial-btn">
                <span class="tech-text">Audit de Sécurité</span>
            </button>
            <div class="security-status">
                <span class="status-text">Niveau de menace</span>
                <span class="status-indicator">CRITIQUE</span>
            </div>
        </div>
    </div>
    <div class="tech-decoration bottom-right"></div>
</section>

<?php require_once 'footer.php'; ?>