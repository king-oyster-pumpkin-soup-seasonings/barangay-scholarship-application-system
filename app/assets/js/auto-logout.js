/**
 * assets/js/auto-logout.js
 * Client-side inactivity auto-logout.
 * NOTE: This is for user experience only.
 * Real security is enforced server-side by auth_check.php.
 */

(function () {
    let inactivityTimer;
    let warningTimer;

    const LIMIT = 15 * 60 * 1000; // 15 minutes (must match INACTIVITY_LIMIT)
    const WARN_AT = 14 * 60 * 1000; // show warning at 14 minutes
    const LOGOUT_URL = "/logout.php?timeout=1"; // change path if needed

    function logout() {
        window.location.href = LOGOUT_URL;
    }

    function showWarning() {
        // Simple warning — replace with a nicer modal if you like
        alert(
            "You will be logged out soon due to inactivity. Move your mouse or press a key to stay logged in.",
        );
    }

    function resetTimer() {
        clearTimeout(inactivityTimer);
        clearTimeout(warningTimer);
        warningTimer = setTimeout(showWarning, WARN_AT);
        inactivityTimer = setTimeout(logout, LIMIT);
    }

    // Any of these activities resets the countdown
    [
        "mousemove",
        "mousedown",
        "keypress",
        "scroll",
        "touchstart",
        "click",
    ].forEach(function (evt) {
        document.addEventListener(evt, resetTimer, { passive: true });
    });

    // Start the timer when the page loads
    resetTimer();
})();
