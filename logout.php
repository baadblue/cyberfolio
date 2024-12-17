<?php
echo 1;
if (isset($_POST['logout'])) {
    echo 2;
    session_start();
    session_destroy();
    echo 3;
    header('Location: login.php');
    exit();
    echo 4;
}
echo 5;