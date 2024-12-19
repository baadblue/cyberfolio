<?php 
// Connection à la base de données
require 'functions/db_operations.php';
$pdo = connection_db();

// Traite les erreurs potentielles lors de l'ouverture de la bdd
if ($pdo[0] === false) {
    die($pdo[1]);
} else {
    $pdo = $pdo[1];
}

// Récupération des projets
$stmt = $pdo->query('SELECT * FROM projects ORDER BY security_level DESC');
$projects = $stmt->fetchAll();

require_once 'head.php'; 
require_once 'nav_bar.php'; 
?>

<section id="projets" class="projects-section">
    <div class="container">
        <h2 class="section-title">Projets Classifiés</h2>
        
        <div class="projects-grid">
            <?php foreach($projects as $project): ?>
                <div class="project-card">
                    <div class="project-header">
                        <i class="<?php echo htmlspecialchars($project['icon']); ?>"></i>
                        <span class="security-level">NIVEAU <?php echo htmlspecialchars($project['security_level']); ?></span>
                    </div>
                    <h3><?php echo htmlspecialchars($project['name']); ?></h3>
                    <p><?php echo htmlspecialchars($project['description']); ?></p>
                    <ul class="project-features">
                        <li><?php echo htmlspecialchars($project['feature1']); ?></li>
                        <li><?php echo htmlspecialchars($project['feature2']); ?></li>
                        <li><?php echo htmlspecialchars($project['feature3']); ?></li>
                    </ul>
                    <div class="project-footer">
                        <span class="project-status"><?php echo htmlspecialchars($project['status']); ?></span>
                        <button class="btn imperial-btn">Accès restreint</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>
