<?php
require_once 'functions/db_operations.php';
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
$citation = $info['citation'];
$titre = $info['titre'];

?>

<?php require_once 'head.php'; ?>
<?php require_once 'nav_bar.php'; ?>

<section id="accueil" class="hero-section">
    <div class="tech-decoration top-left"></div>
    <div class="hero-content">
        <h1><?php echo strtoupper($firstname) . ' ' . strtoupper($lastname); ?></h1>
        <h2 class="tech-title"><?php echo $titre; ?></h2>
        <p class="tagline"><?php echo $citation; ?></p>

        <div class="hero-cta">
            <div class="security-status">
                <span class="status-text">Niveau de menace</span>
                <span class="status-indicator">CRITIQUE</span>
            </div>
        </div>
        <div class="terminal-window">
            <div class="terminal-header">
                <span class="terminal-title">terminal@deathstar</span>
                <div class="terminal-buttons">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="terminal-content">
                <p><span class="prompt">$</span> cat last_breach.txt</p>
                <div id="security-breach">
                    Chargement des données sur les failles de sécurité...
                </div>
            </div>
        </div>
    </div>

    <div class="tech-decoration bottom-right"></div>
</section>

<?php require_once 'footer.php'; ?>