<?php
// Permet l'accès seulement aux utilisateurs connectés
require_once 'functions/auth.php';
access_connected_users_only();

// Connection à la base de données
require 'functions/db_operations.php';
$pdo = connection_db();

// Traite les erreurs potentielles lors de l'ouverture de la bdd
if ($pdo[0] === false) {
    die($pdo[1]);
} else {
    $pdo = $pdo[1];
}

// Traitement de la suppression
if (isset($_POST['delete']) && isset($_POST['competence_id'])) {
    $stmt = $pdo->prepare('DELETE FROM competences WHERE id = ?');
    $stmt->execute([$_POST['competence_id']]);
    header('Location: modif_competences.php');
    exit();
}

// Traitement de l'ajout/modification
if (isset($_POST['submit'])) {
    if (isset($_POST['competence_id'])) {
        // Modification
        $stmt = $pdo->prepare('UPDATE competences SET name = ?, icon = ?, feature1 = ?, feature2 = ?, feature3 = ?, security_level = ? WHERE id = ?');
        $stmt->execute([
            $_POST['name'],
            $_POST['icon'],
            $_POST['feature1'],
            $_POST['feature2'],
            $_POST['feature3'],
            $_POST['security_level'],
            $_POST['competence_id']
        ]);
    } else {
        // Ajout
        $stmt = $pdo->prepare('INSERT INTO competences (name, icon, feature1, feature2, feature3, security_level) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $_POST['name'],
            $_POST['icon'],
            $_POST['feature1'],
            $_POST['feature2'],
            $_POST['feature3'],
            $_POST['security_level']
        ]);
    }
    header('Location: modif_competences.php');
    exit();
}

// Récupération des compétences
$stmt = $pdo->query('SELECT * FROM competences ORDER BY security_level DESC');
$competences = $stmt->fetchAll();

// Récupération d'une compétence spécifique pour modification
$competence_to_edit = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM competences WHERE id = ?');
    $stmt->execute([$_GET['edit']]);
    $competence_to_edit = $stmt->fetch();
}
?>

<?php require 'head.php';
require 'nav_bar_dashboard.php' ?>

    <div class="main-content">
        <div class="content-header">
            <h1><?php echo $competence_to_edit ? 'Modifier une compétence' : 'Ajouter une compétence'; ?></h1>
        </div>
        
        <div class="content">
            <form action="" method="POST" class="project-form">
                <?php if ($competence_to_edit): ?>
                    <input type="hidden" name="competence_id" value="<?php echo $competence_to_edit['id']; ?>">
                <?php endif; ?>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Nom de la compétence</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="<?php echo $competence_to_edit ? htmlspecialchars($competence_to_edit['name']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="security_level">Niveau de sécurité</label>
                        <select id="security_level" name="security_level" class="form-control" required>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <option value="<?php echo $i; ?>" <?php echo ($competence_to_edit && $competence_to_edit['security_level'] == $i) ? 'selected' : ''; ?>>
                                    NIVEAU <?php echo $i; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="icon">Icône (classe Remix Icon)</label>
                    <input type="text" id="icon" name="icon" class="form-control"
                           value="<?php echo $competence_to_edit ? htmlspecialchars($competence_to_edit['icon']) : ''; ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="feature1">Fonctionnalité 1</label>
                        <input type="text" id="feature1" name="feature1" class="form-control"
                               value="<?php echo $competence_to_edit ? htmlspecialchars($competence_to_edit['feature1']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="feature2">Fonctionnalité 2</label>
                        <input type="text" id="feature2" name="feature2" class="form-control"
                               value="<?php echo $competence_to_edit ? htmlspecialchars($competence_to_edit['feature2']) : ''; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="feature3">Fonctionnalité 3</label>
                    <input type="text" id="feature3" name="feature3" class="form-control"
                           value="<?php echo $competence_to_edit ? htmlspecialchars($competence_to_edit['feature3']) : ''; ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" name="submit" class="btn imperial-btn">
                        <?php echo $competence_to_edit ? 'Modifier la compétence' : 'Ajouter la compétence'; ?>
                    </button>
                    <?php if ($competence_to_edit): ?>
                        <button type="submit" name="delete" class="btn delete-btn" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette compétence ?')">
                            Supprimer la compétence
                        </button>
                    <?php endif; ?>
                </div>
            </form>
            </div>


    <div class="competences-list">
        <h2>Compétences existantes</h2>
        <div class="projects-grid">
            <?php foreach($competences as $competence): ?>
                <div class="project-card">
                    <div class="project-header">
                        <i class="<?php echo htmlspecialchars($competence['icon']); ?>"></i>
                        <span class="security-level">NIVEAU <?php echo htmlspecialchars($competence['security_level']); ?></span>
                    </div>
                    <h3><?php echo htmlspecialchars($competence['name']); ?></h3>
                    <ul class="project-features">
                        <li><?php echo htmlspecialchars($competence['feature1']); ?></li>
                        <li><?php echo htmlspecialchars($competence['feature2']); ?></li>
                        <li><?php echo htmlspecialchars($competence['feature3']); ?></li>
                    </ul>
                    <div class="project-footer">
                        <a href="?edit=<?php echo $competence['id']; ?>" class="btn imperial-btn">Modifier</a>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="competence_id" value="<?php echo $competence['id']; ?>">
                            <button type="submit" name="delete" class="btn delete-btn-alt" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette compétence ?')">
                                <i class="ri-delete-bin-line"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

        </div>
    </div>
</div>
</body>
</html> 