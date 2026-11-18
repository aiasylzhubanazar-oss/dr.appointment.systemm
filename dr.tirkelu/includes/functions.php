<?php
// Көмекші функциялар

// XSS-тен қорғау: пайдаланушы мәтінін HTML-ге шығарар алдында міндетті түрде қолданамыз
function e(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

// POST-тан таза мәтін алу
function post(string $key): string {
    return trim($_POST[$key] ?? '');
}

// Қатені шығару үшін
function error_html(array $errors, string $field): string {
    return isset($errors[$field]) ? e($errors[$field]) : '';
}
