<?php
/**
 * includes/auth_check.php
 * Verifies login + enforces inactivity timeout + session ID rotation.
 * Include this at the VERY TOP of every page that requires login.
 */

// Start a secure session (this also calls session_start())
require_once __DIR__ . '/session_config.php';

// ===== SETTINGS =====
define('INACTIVITY_LIMIT', 900);   // 15 minutes of inactivity (in seconds)
define('REGENERATE_AFTER', 1800);  // rotate session ID every 30 minutes
// ====================

// 1. Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: " . loginUrl());
    exit();
}

// 2. Enforce inactivity timeout
if (isset($_SESSION['last_activity'])) {
    $elapsed = time() - $_SESSION['last_activity'];
    if ($elapsed > INACTIVITY_LIMIT) {
        session_unset();
        session_destroy();
        header("Location: " . loginUrl() . "?timeout=1");
        exit();
    }
}

// 3. Update the activity timestamp on every request
$_SESSION['last_activity'] = time();

// 4. Periodically regenerate the session ID (anti session-hijacking)
if (!isset($_SESSION['created'])) {
    $_SESSION['created'] = time();
} else if (time() - $_SESSION['created'] > REGENERATE_AFTER) {
    session_regenerate_id(true);
    $_SESSION['created'] = time();
}

/**
 * Helper: builds a correct path to login.php no matter
 * which folder the protected page is in.
 */
function loginUrl() {
    // CHANGE '/login.php' if your login page is elsewhere
    return "/login.php";
}
