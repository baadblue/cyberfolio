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
?>

<?php require 'head.php';
require 'nav_bar_dashboard.php' ?>

    <!-- Contenu principal -->
    <div class="main-content">
        <div class="content-header">
            <h1>Tableau de bord</h1>
        </div>
        
        <div class="content">
            <!-- Ici viendra le contenu de votre dashboard -->
        </div>
    </div>
</div>

</body>
</html>