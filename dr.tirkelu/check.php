<?php
// Тексеру беті: http://localhost/dr.tirkelu/check.php
// Жоба толық жұмыс істегенде бұл файлды өшіріп тастаңыз.
require_once __DIR__ . '/includes/db.php';

function row(string $label, bool $ok, string $note = ''): void {
    echo '<tr><td>' . htmlspecialchars($label) . '</td><td class="' . ($ok ? 'ok' : 'bad') . '">'
       . ($ok ? '✓ Дұрыс' : '✗ Қате') . '</td><td>' . htmlspecialchars($note) . '</td></tr>';
}
$files = ['index.php','doctors.php','login.php','register.php','logout.php','profile.php',
          'includes/auth.php','includes/db.php','includes/header.php','includes/footer.php',
          'includes/functions.php','includes/data.php','css/style.css','js/app.js'];
?>
<!DOCTYPE html>
<html lang="kk"><head><meta charset="UTF-8"><title>Тексеру | Dr.tirkelu</title>
<style>
body{font-family:system-ui,sans-serif;max-width:820px;margin:30px auto;padding:0 16px}
table{border-collapse:collapse;width:100%}td{border:1px solid #ccc;padding:6px 10px}
.ok{color:#0a7a2f;font-weight:700}.bad{color:#c00000;font-weight:700}
</style></head><body>
<h1>Dr.tirkelu: жүйені тексеру</h1>
<p>Барлық жолдар жасыл (✓) болуы керек.</p>
<table>
<?php
row('PHP нұсқасы', version_compare(PHP_VERSION, '8.0.0', '>='), PHP_VERSION);
row('Кеңейтім: mbstring', extension_loaded('mbstring'));
row('Кеңейтім: pdo_mysql', extension_loaded('pdo_mysql'));
row('Жоба папкасы', true, __DIR__);

foreach ($files as $f) {
    $ok = is_file(__DIR__ . '/' . $f);
    row('Файл: ' . $f, $ok, $ok ? '' : 'Табылмады');
}

$old = __DIR__ . '/js/script.js';
row('Ескі js/script.js жоқ', !is_file($old), is_file($old) ? 'Бар, бірақ қолданылмайды' : '');

$js = @file_get_contents(__DIR__ . '/js/app.js');
row('app.js ішінде ескі alert жоқ', $js !== false && strpos($js, 'alert(') === false);

$authFile = __DIR__ . '/includes/auth.php';
if (is_file($authFile)) {
    require_once $authFile;
    row('auth.php: csrf_field() бар', function_exists('csrf_field'));
    row('auth.php: require_login() бар', function_exists('require_login'));
}

try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    row('MySQL қосылымы', true, DB_NAME . ' (порт ' . DB_PORT . ')');
    foreach (['users', 'specialties', 'doctors', 'appointments'] as $t) {
        try {
            $n = $pdo->query("SELECT COUNT(*) FROM `$t`")->fetchColumn();
            row('Кесте: ' . $t, true, $n . ' жазба');
        } catch (PDOException $e) {
            row('Кесте: ' . $t, false, 'Табылмады. database.sql импорттаңыз');
        }
    }
} catch (PDOException $e) {
    row('MySQL қосылымы', false, 'Қосылмады: MySQL қосулы ма? includes/db.php ішіндегі порт дұрыс па? dr_tirkelu дерекқоры бар ма?');
}
?>
</table>
<p><a href="index.php">Басты бетке</a> · <a href="register.php">Тіркелу</a> · <a href="login.php">Кіру</a></p>
</body></html>
