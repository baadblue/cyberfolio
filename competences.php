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

// Récupération des compétences
$stmt = $pdo->query('SELECT * FROM competences ORDER BY security_level DESC');
$competences = $stmt->fetchAll();

require_once 'head.php'; 
require_once 'nav_bar.php'; 
?>

<section id="competences" class="skills-section">
    <div class="container">
        <h2 class="section-title">Arsenal Cybernétique</h2>
        
        <div class="skills-grid">
            <?php foreach($competences as $competence): ?>
                <div class="skill-card">
                    <div class="card-header">
                        <i class="<?php echo htmlspecialchars($competence['icon']); ?>"></i>
                        <h3><?php echo htmlspecialchars($competence['name']); ?></h3>
                    </div>
                    <ul>
                        <li><?php echo htmlspecialchars($competence['feature1']); ?></li>
                        <li><?php echo htmlspecialchars($competence['feature2']); ?></li>
                        <li><?php echo htmlspecialchars($competence['feature3']); ?></li>
                    </ul>
                    <div class="skill-meter">
                        <div class="meter-fill" style="width: <?php echo ($competence['security_level'] * 20); ?>%"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>