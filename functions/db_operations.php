<?php

function connection_db () {
    try {
        $config = require 'ds58f47r/config.php';
        
        $dbHost = $config['DB_HOST'];
        $dbName = $config['DB_NAME'];
        $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
        $username = $config['DB_USER'];
        $password = $config['DB_PASS'];
        // Connexion à la base de données avec PDO
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return [true, $pdo];
    } catch (PDOException $e) {
        return [false, ("Erreur : " . $e->getMessage())];
    }
}

function verify_login ($pdo, $email, $password) {
    $requete = "SELECT id_profile FROM profile WHERE email = :email AND password = :password";
    $stmt = $pdo -> prepare($requete);
    $stmt -> execute([':email' => $email]);

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row["id_profile"];
}

function recover_user_info ($pdo, $id) {
    $requete = "SELECT firstname, lastname, email, citation, titre FROM profile WHERE id_profile = :id";
    $stmt = $pdo -> prepare($requete);
    $stmt -> execute([':id' => $id]);

    $info = $stmt->fetch(PDO::FETCH_ASSOC);
    return  ['firstname' => $info['firstname'],
            'lastname' => $info['lastname'],
            'email' => $info['email'],
            'citation' => $info['citation'],
            'titre' => $info['titre'],
        ];
}