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


if (isset($_GET)) {
    if ($_GET['modif'] === 'user') {
        $requete = "UPDATE profile 
                    SET firstname = :firstname, 
                    lastname = :lastname, 
                    email = :email 
                    WHERE id_profile = :id";
        $stmt = $pdo -> prepare($requete);
        $stmt -> execute([':id' => 1,
                        ':firstname' => $_POST['firstname'],
                        ':lastname' => $_POST['lastname'],
                        ':email' => $_POST['email']
                    ]);
    }
}