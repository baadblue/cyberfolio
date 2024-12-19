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
if (isset($_POST['delete']) && isset($_POST['project_id'])) {
    $stmt = $pdo->prepare('DELETE FROM projects WHERE id = ?');
    $stmt->execute([$_POST['project_id']]);
    header('Location: modif_projects.php');
    exit();
}

// Traitement de l'ajout/modification
if (isset($_POST['submit'])) {
    if (isset($_POST['project_id'])) {
        // Modification
        $stmt = $pdo->prepare('UPDATE projects SET name = ?, description = ?, security_level = ?, icon = ?, feature1 = ?, feature2 = ?, feature3 = ?, status = ? WHERE id = ?');
        $stmt->execute([
            $_POST['name'],
            $_POST['description'],
            $_POST['security_level'],
            $_POST['icon'],
            $_POST['feature1'],
            $_POST['feature2'],
            $_POST['feature3'],
            $_POST['status'],
            $_POST['project_id']
        ]);
    } else {
        // Ajout
        $stmt = $pdo->prepare('INSERT INTO projects (name, description, security_level, icon, feature1, feature2, feature3, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $_POST['name'],
            $_POST['description'],
            $_POST['security_level'],
            $_POST['icon'],
            $_POST['feature1'],
            $_POST['feature2'],
            $_POST['feature3'],
            $_POST['status']
        ]);
    }
    header('Location: modif_projects.php');
    exit();
}

// Récupération des projets
$stmt = $pdo->query('SELECT * FROM projects ORDER BY security_level DESC');
$projects = $stmt->fetchAll();

// Récupération d'un projet spécifique pour modification
$project_to_edit = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM projects WHERE id = ?');
    $stmt->execute([$_GET['edit']]);
    $project_to_edit = $stmt->fetch();
}
?>

<?php require 'head.php';
require 'nav_bar_dashboard.php' ?>

    <div class="main-content">
        <div class="content-header">
            <h1><?php echo $project_to_edit ? 'Modifier le projet' : 'Ajouter un projet'; ?></h1>
        </div>
        
        <div class="content">
            <form action="" method="POST" class="form-container project-form">
                <?php if ($project_to_edit): ?>
                    <input type="hidden" name="project_id" value="<?php echo $project_to_edit['id']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="name">Nom du projet</label>
                    <input type="text" name="name" value="<?php echo $project_to_edit ? htmlspecialchars($project_to_edit['name']) : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" required><?php echo $project_to_edit ? htmlspecialchars($project_to_edit['description']) : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="security_level">Niveau de sécurité</label>
                    <select name="security_level" required>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo ($project_to_edit && $project_to_edit['security_level'] == $i) ? 'selected' : ''; ?>>
                                NIVEAU <?php echo $i; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="icon">Icône (classe Remix Icon)</label>
                    <input type="text" name="icon" value="<?php echo $project_to_edit ? htmlspecialchars($project_to_edit['icon']) : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="feature1">Fonctionnalité 1</label>
                    <input type="text" name="feature1" value="<?php echo $project_to_edit ? htmlspecialchars($project_to_edit['feature1']) : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="feature2">Fonctionnalité 2</label>
                    <input type="text" name="feature2" value="<?php echo $project_to_edit ? htmlspecialchars($project_to_edit['feature2']) : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="feature3">Fonctionnalité 3</label>
                    <input type="text" name="feature3" value="<?php echo $project_to_edit ? htmlspecialchars($project_to_edit['feature3']) : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="status">Statut</label>
                    <select name="status" required>
                        <option value="ACTIF" <?php echo ($project_to_edit && $project_to_edit['status'] == 'ACTIF') ? 'selected' : ''; ?>>ACTIF</option>
                        <option value="EN PRODUCTION" <?php echo ($project_to_edit && $project_to_edit['status'] == 'EN PRODUCTION') ? 'selected' : ''; ?>>EN PRODUCTION</option>
                        <option value="DÉPLOYÉ" <?php echo ($project_to_edit && $project_to_edit['status'] == 'DÉPLOYÉ') ? 'selected' : ''; ?>>DÉPLOYÉ</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" name="submit" class="btn imperial-btn">
                        <?php echo $project_to_edit ? 'Modifier' : 'Ajouter'; ?>
                    </button>
                    <?php if ($project_to_edit): ?>
                        <button type="submit" name="delete" class="btn delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
                            Supprimer
                        </button>
                    <?php endif; ?>
                </div>
            </form>

            <div class="projects-list">
                <h2>Projets existants</h2>
                <div class="projects-grid admin-grid">
                    <?php foreach($projects as $project): ?>
                        <div class="project-card admin-card">
                            <div class="project-header">
                                <i class="<?php echo htmlspecialchars($project['icon']); ?>"></i>
                                <span class="security-level">NIVEAU <?php echo htmlspecialchars($project['security_level']); ?></span>
                            </div>
                            <h3><?php echo htmlspecialchars($project['name']); ?></h3>
                            <p><?php echo htmlspecialchars($project['description']); ?></p>
                            <span class="project-status"><?php echo htmlspecialchars($project['status']); ?></span>
                            <div class="project-footer admin-footer">
                                <a href="?edit=<?php echo $project['id']; ?>" class="btn imperial-btn">Modifier</a>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                                    <button type="submit" name="delete" class="btn delete-btn-alt" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')">
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