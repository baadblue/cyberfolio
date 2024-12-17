<?php

function is_connected() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['id'])) {
        return FALSE;
    } else {
        if ($_SESSION['id'] === 123) {
            return TRUE;
        } else {
            return FALSE;
        }
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