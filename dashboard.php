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

try {
    $firstname = 'admin';

    $requete = "SELECT * FROM profile WHERE firstname = :firstname";
    $stmt = $pdo -> prepare($requete);

    $stmt -> execute([':firstname' => $firstname]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<br>id : " . $row['id_profile'] . " <br>- Nom : " . $row['firstname'] . " <br>- Email : " . $row['email'] . "<br>";
    }
} catch (PDOException $e) {
    die("Erreur lors de l'insertion : " . $e->getMessage());
}
?>

<?php require 'head.php'; ?>

<div class="dashboard-container">
    <!-- Nouvelle Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <h2>Empire Galactique</h2>
            </div>
        </div>
        
        <div class="sidebar-menu">
            <ul>
                <li class="menu-header">Navigation</li>
                <li><a href="dashboard.php" class="active"><i class="ri-dashboard-line"></i> Tableau de bord</a></li>
                <li><a href="index.php"><i class="ri-home-4-line"></i> Voir le site</a></li>
                
                <li class="menu-header">Gestion des données</li>
                <li><a href="users.php"><i class="ri-user-settings-line"></i> Gestion utilisateurs</a></li>
                <li><a href="products.php"><i class="ri-shopping-bag-line"></i> Gestion produits</a></li>
                <li><a href="categories.php"><i class="ri-folder-settings-line"></i> Gestion catégories</a></li>
                
                <li class="menu-header">Paramètres</li>
                <li><a href="profile.php"><i class="ri-user-line"></i> Mon profil</a></li>
                <li><a href="settings.php"><i class="ri-settings-4-line"></i> Paramètres</a></li>
                <li><a href="logout.php"><i class="ri-logout-box-line"></i> Déconnexion</a></li>
            </ul>
        </div>
    </div>

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

<style>
.dashboard-container {
    display: flex;
    min-height: 100vh;
}

.sidebar {
    width: 250px;
    background: #1a1a1a;
    color: #fff;
    position: fixed;
    height: 100vh;
    left: 0;
    top: 0;
}

.sidebar-header {
    padding: 20px;
    border-bottom: 1px solid #2c2c2c;
}

.sidebar-menu {
    padding: 20px 0;
}

.sidebar-menu ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu-header {
    padding: 10px 20px;
    font-size: 12px;
    text-transform: uppercase;
    color: #666;
    margin-top: 15px;
}

.sidebar-menu ul li a {
    padding: 12px 20px;
    display: flex;
    align-items: center;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s;
}

.sidebar-menu ul li a:hover {
    background: #2c2c2c;
}

.sidebar-menu ul li a i {
    margin-right: 10px;
    font-size: 18px;
}

.sidebar-menu ul li a.active {
    background: #2c2c2c;
    border-left: 4px solid #007bff;
}

.main-content {
    flex: 1;
    margin-left: 250px;
    padding: 20px;
}

.content-header {
    margin-bottom: 30px;
}

.content-header h1 {
    margin: 0;
    font-size: 24px;
}
</style>

</body>
</html>