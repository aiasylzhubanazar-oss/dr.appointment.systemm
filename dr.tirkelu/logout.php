<?php
require_once 'includes/auth.php';

// Шығу тек POST арқылы және CSRF токенімен жұмыс істейді
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valid()) {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
    session_start();
    $_SESSION['flash_ok'] = 'Жүйеден шықтыңыз.';
}
header('Location: login.php');
exit;
