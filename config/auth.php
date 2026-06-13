<?php
// Session Management
session_start();

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Redirect to login if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit();
    }
}

// Redirect to login if not admin
function requireAdmin() {
    if (!isAdmin()) {
        header('Location: login.php');
        exit();
    }
}

// Login user
function loginUser($user_id, $role) {
    $_SESSION['user_id'] = $user_id;
    $_SESSION['role'] = $role;
}

// Logout user
function logoutUser() {
    session_destroy();
}

// Get current user
function getCurrentUser() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

?>