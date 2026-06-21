<?php
/**
 * includes/session_config.php
 * Secure session settings. MUST be included before session_start().
 */

// Only send cookies over HTTPS.
// If you're testing on plain http://localhost, set this to 0 temporarily.
ini_set('session.cookie_secure', 1);

// Block JavaScript from reading the session cookie (anti-XSS theft)
ini_set('session.cookie_httponly', 1);

// Reject session IDs the server never generated (anti session-fixation)
ini_set('session.use_strict_mode', 1);

// Don't send the cookie on cross-site requests (anti-CSRF)
ini_set('session.cookie_samesite', 'Strict');

// Start the session
session_start();
