<?php

function is_connected() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['id'])) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function access_connected_users_only() {
    if (!is_connected()) {
        header('Location: login.php');
        exit();
    }
}

function redirect() {
    if (is_connected()) {
        header('Location: dashboard.php');
        exit();
    }
}