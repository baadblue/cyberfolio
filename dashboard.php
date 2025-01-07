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

// Récupération des informations "À propos"
$stmt = $pdo->query('SELECT * FROM about WHERE id = 1');
$about = $stmt->fetch();

// Traitement de l'upload d'image
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $filename = $_FILES['image']['name'];
    $filetype = pathinfo($filename, PATHINFO_EXTENSION);

    if (in_array(strtolower($filetype), $allowed)) {
        $new_filename = 'vader-portrait.' . $filetype;
        $upload_path = 'assets/sources/' . $new_filename;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
            // Mise à jour du chemin dans la base de données
            $stmt = $pdo->prepare('UPDATE about SET image_path = ? WHERE id = 1');
            $stmt->execute(['assets/sources/' . $new_filename]);
        }
    }
}

// Traitement de la mise à jour des informations
if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare('UPDATE about SET identification = ?, bugs_fixed = ?, system_uptime = ?, code_lines = ? WHERE id = 1');
    $stmt->execute([
        $_POST['identification'],
        $_POST['bugs_fixed'],
        $_POST['system_uptime'],
        $_POST['code_lines']
    ]);
    header('Location: dashboard.php');
    exit();
}
?>

<?php require 'head.php';
require 'nav_bar_dashboard.php' ?>

    <div class="main-content">
        <div class="content-header">
            <h1>Tableau de bord</h1>
        </div>
        
        <div class="content">
            <form action="" method="POST" enctype="multipart/form-data" class="project-form">
                <h2 style="margin-bottom: 40px;">Principal dashboard</h2>

                <div class="form-group">
                    <label for="identification">Texte d'identification</label>
                    <textarea id="identification" name="identification" class="form-control" required><?php echo htmlspecialchars($about['identification']); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="bugs_fixed">Failles corrigées</label>
                        <input type="text" id="bugs_fixed" name="bugs_fixed" class="form-control"
                               value="<?php echo htmlspecialchars($about['bugs_fixed']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="system_uptime">Uptime système</label>
                        <input type="text" id="system_uptime" name="system_uptime" class="form-control"
                               value="<?php echo htmlspecialchars($about['system_uptime']); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="code_lines">Lignes de code</label>
                    <input type="text" id="code_lines" name="code_lines" class="form-control"
                           value="<?php echo htmlspecialchars($about['code_lines']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="image">Image de profil</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    <small class="form-text">Image actuelle : <?php echo htmlspecialchars($about['image_path']); ?></small>
                </div>

                <div class="current-image">
                    <img src="<?php echo htmlspecialchars($about['image_path']); ?>" alt="Image actuelle" style="max-width: 200px; margin: 10px 0;">
                </div>

                <div class="form-actions">
                    <button type="submit" name="submit" class="btn imperial-btn">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>