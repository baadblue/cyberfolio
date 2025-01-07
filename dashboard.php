<?php
// Permet l'accès seulement aux utilisateurs connectés
require_once 'functions/auth.php';
access_connected_users_only();

require 'head.php';
require 'nav_bar_dashboard.php';
?>

<div class="main-content">
    <div class="content-header">
        <h1>Tableau de bord</h1>
    </div>
    
    <div class="content" style="height: calc(100vh - 100px); display: flex; align-items: center; justify-content: center;">
        <div class="dashboard-image" style="
            max-width: 90%;
            max-height: 85vh;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
            border: 2px solid var(--vader-red);
        ">
            <img src="assets/sources/Dark-Vador-Badass-lava.jpeg" alt="Dark Vador" style="
                width: 100%;
                height: 100%;
                object-fit: contain;
                display: block;
            ">
        </div>
    </div>
</div>

</body>
</html>