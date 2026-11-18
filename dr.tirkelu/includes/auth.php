<?php
// Сессия және аутентификация функциялары. Әр беттің ЕҢ БАСЫНДА қосылады.
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
    session_start();
}

function is_logged_in(): bool {
    return !empty($_SESSION['user_id']);
}

function is_admin(): bool {
    return is_logged_in() && ($_SESSION['user_role'] ?? '') === 'admin';
}

// Жабық беттерді қорғау: кірмеген адамды login.php-ге жібереді
function require_login(): void {
    if (!is_logged_in()) {
        $_SESSION['flash_error'] = 'Бұл бетті көру үшін жүйеге кіріңіз.';
        header('Location: login.php');
        exit;
    }
}

function require_admin(): void {
    require_login();
    if (!is_admin()) {
        http_response_code(403);
        exit('Рұқсат жоқ: бұл бет тек әкімшіге арналған.');
    }
}

// Бір рет көрсетілетін хабарлама
function flash(string $key): ?string {
    $msg = $_SESSION[$key] ?? null;
    unset($_SESSION[$key]);
    return $msg;
}

// CSRF қорғанысы
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf" value="' . csrf_token() . '">';
}

function csrf_valid(): bool {
    return isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}
