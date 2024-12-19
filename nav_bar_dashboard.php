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
    border-bottom: 1px solid #FF0000;
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
    border-left: 4px solid #FF0000;
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
                <li><a href="modif_user.php"><i class="ri-user-settings-line"></i> Gestion utilisateur</a></li>
                <li><a href="modif_competences.php"><i class="ri-folder-settings-line"></i> Gestion compétences</a></li>
                <li><a href="modif_projects.php"><i class="ri-shopping-bag-line"></i> Gestion projets</a></li>
                
                
                <li class="menu-header">Paramètres</li>
                <li><a href="logout.php"><i class="ri-logout-box-line"></i> Déconnexion</a></li>
            </ul>
        </div>
    </div>
