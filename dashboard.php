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
    
    <div class="content" style="
        height: calc(100vh - 120px); 
        display: flex; 
        align-items: center; 
        justify-content: center;
        padding: 20px;
    ">
        <div class="dashboard-image" style="
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
            border: 2px solid var(--vader-red);
        ">
            <img src="assets/sources/meme_compil.png" alt="Dark Vador" style="
                max-height: calc(100vh - 160px);
                width: auto;
                display: block;
                border-radius: 8px;
            ">
        </div>
    </div>
</div>

</body>
</html>