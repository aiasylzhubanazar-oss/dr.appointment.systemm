<?php
// MySQL-ге PDO арқылы қосылу. XAMPP-тың әдепкі баптаулары.
const DB_HOST = 'localhost';
const DB_PORT = '3306';      // MySQL порты басқа болса (мысалы 3307), осында өзгертіңіз
const DB_NAME = 'dr_tirkelu';
const DB_USER = 'root';
const DB_PASS = '';          // XAMPP-та әдепкі құпия сөз бос

function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            http_response_code(500);
            exit('Дерекқорға қосыла алмады. XAMPP-та MySQL қосулы екенін, дерекқор импортталғанын және includes/db.php баптауларын тексеріңіз.');
        }
    }
    return $pdo;
}
