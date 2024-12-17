<?php
require_once 'functions/auth.php';
access_connected_users_only();

require 'head.php';

$dsn = "mysql:host=localhost;dbname=portfolio;charset=utf8mb4";
$username = "root";
$password = "root";

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie !";
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
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

<nav class="navbar">
    <ul class="menu">
        <li><a href="index.php">Mon Site</a></li>
        <li><a href="logout.php">Deconnection</a></li>
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
            <li><a href="index.php#a-propos"><i class="ri-user-line"></i> À Propos</a></li>
            <li><a href="index.php#competences"><i class="ri-sword-line"></i> Compétences</a></li>
            <li><a href="index.php#projets"><i class="ri-planet-line"></i> Projets</a></li>
            <li><a href="contact.php"><i class="ri-message-2-line"></i> Contact</a></li>
        </ul>
    </div>
</nav>

</body>
</html>