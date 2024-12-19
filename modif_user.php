<?php

// Permet l'accès seulement aux utilisateur connectés
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

$info = recover_user_info($pdo, $_SESSION['id']);
$firstname = $info['firstname'];
$lastname = $info['lastname'];
$email = $info['email'];
?>

<?php require 'head.php';
require 'nav_bar_dashboard.php' ?>

    <!-- Contenu principal -->
    <div class="main-content">
        <div class="content-header">
            <h1>Modifier l'utilisateur</h1>
        </div>
        
        <div class="content">
            <form action="" method="POST" class="form-container">
                <div class="form-group">
                    <label for="firstname">Nom</label>
                    <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname) ?>">
                </div>
                <div class="form-group">
                    <label for="lastname">Prénom</label>
                    <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname) ?>">
                </div>
                <div class="form-group">
                    <label for="email">Adresse mail</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn imperial-btn">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>