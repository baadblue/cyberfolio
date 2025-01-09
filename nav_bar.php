<?php
require_once 'functions/db_operations.php';
$pdo = connection_db();

// Traite les erreurs potentielles lors de l'ouverture de la bdd
if ($pdo[0] === false) {
    die($pdo[1]);
} else {
    $pdo = $pdo[1];
}
$info = recover_user_info($pdo, 1);
$firstname = $info['firstname'];
$lastname = $info['lastname'];
?>

<nav class="navbar">
    <div class="logo">
        <a href="login.php">
            <img src="assets/sources/laser.png" alt="Logo" class="logo-image">
        </a>
        <a href="index.php"><?php echo ucfirst($firstname) . ' ' . ucfirst($lastname); ?></a>
    </div>
    <i class="ri-menu-fill" id="open_menu"></i>
    <ul class="menu">
        <li><a href="index.php#accueil">Accueil</a></li>
        <li><a href="a-propos.php">À Propos</a></li>
        <li><a href="competences.php">Compétences</a></li>
        <li><a href="projets.php">Projets</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>

    <div class="sidebar_menu">
        <ul class="sidebar_top">
            <li>
                <div class="logo sidebar_logo">
                    <a href="#">Empire Galactique</a>
                </div>
                <i class="ri-close-line" id="close_menu"></i>
            </li>
            <li><a href="index.php#accueil"><i class="ri-home-4-line"></i> Accueil</a></li>
            <li><a href="a-propos.php"><i class="ri-user-line"></i> À Propos</a></li>
            <li><a href="competences.php"><i class="ri-sword-line"></i> Compétences</a></li>
            <li><a href="projets.php"><i class="ri-planet-line"></i> Projets</a></li>
            <li><a href="contact.php"><i class="ri-message-2-line"></i> Contact</a></li>
        </ul>
    </div>
</nav>