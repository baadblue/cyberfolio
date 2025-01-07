<?php 
require_once 'head.php';
require_once 'nav_bar.php';

// Connection à la base de données
require 'functions/db_operations.php';
$pdo = connection_db();

// Traite les erreurs potentielles lors de l'ouverture de la bdd
if ($pdo[0] === false) {
    die($pdo[1]);
} else {
    $pdo = $pdo[1];
}

// Récupération des informations
$stmt = $pdo->query('SELECT * FROM about WHERE id = 1');
$about = $stmt->fetch();
?>

<section id="a-propos" class="about-section">
    <div class="container">
        <h2 class="section-title">Identité Système</h2>
        
        <div class="about-grid">
            <div class="about-image">
                <img src="<?php echo htmlspecialchars($about['image_path']); ?>" alt="Dark Vador">
                <div class="system-scan"></div>
            </div>
            
            <div class="about-content">
                <div class="about-card">
                    <div class="card-header">
                        <i class="ri-shield-user-line"></i>
                        <h3>Identification</h3>
                    </div>
                    <p class="about-text"><?php echo htmlspecialchars($about['identification']); ?></p>
                </div>

                <div class="about-stats">
                    <div class="stat-item">
                        <i class="ri-bug-line"></i>
                        <span class="stat-number"><?php echo htmlspecialchars($about['bugs_fixed']); ?></span>
                        <span class="stat-label">Failles corrigées</span>
                    </div>
                    <div class="stat-item">
                        <i class="ri-shield-check-line"></i>
                        <span class="stat-number"><?php echo htmlspecialchars($about['system_uptime']); ?></span>
                        <span class="stat-label">Uptime système</span>
                    </div>
                    <div class="stat-item">
                        <i class="ri-code-box-line"></i>
                        <span class="stat-number"><?php echo htmlspecialchars($about['code_lines']); ?></span>
                        <span class="stat-label">Lignes de code</span>
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
                        <p><span class="prompt">$</span> whoami</p>
                        <p class="response">DarkVador@EmpireGalactic</p>
                        <p><span class="prompt">$</span> cat skills.txt</p>
                        <p class="response">Pentesting avancé</p>
                        <p class="response">Exploitation des failles</p>
                        <p class="response">Architecture sécurisée</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>
