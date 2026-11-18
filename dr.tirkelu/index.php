<?php
require_once 'includes/auth.php';
$pageTitle = 'Басты бет';
$active = 'index.php';
include 'includes/header.php';
?>
<main>
<div class="hero-band"><div class="container hero">
<div><h1>Дәрігерге жазылу — бірнеше секундта</h1>
<p>Дәрігерді таңдаңыз, бос уақытты көріңіз, кезекте тұрмай жазылыңыз.</p>
<div class="hero-actions"><a class="btn white" href="doctors.php">Дәрігерге жазылу</a>
<?php if (is_logged_in()): ?><a class="btn black" href="profile.php">Менің профилім</a>
<?php else: ?><a class="btn black" href="register.php">Тіркелу</a><a class="btn outline-w" href="login.php">Кіру</a><?php endif; ?></div></div>
<div class="slots-panel"><h2>Терапевт, ертең</h2><small>Бос уақытты таңдап көріңіз</small>
<div class="slots" role="group" aria-label="Бос уақыттар">
<button class="slot">09:00</button><button class="slot busy" disabled>09:30</button><button class="slot">10:00</button>
<button class="slot">10:30</button><button class="slot busy" disabled>11:00</button><button class="slot">11:30</button>
<button class="slot">14:00</button><button class="slot">14:30</button><button class="slot busy" disabled>15:00</button></div>
<div id="slot-msg" aria-live="polite"></div></div>
</div></div>
<div class="container"><section><h2 class="title">Мамандықтар</h2><div class="grid">
<div class="card spec-card"><h3>Терапевт</h3><p>Жалпы қабылдау және алғашқы тексеру</p></div>
<div class="card spec-card"><h3>Кардиолог</h3><p>Жүрек және қан тамырлары</p></div>
<div class="card spec-card"><h3>Педиатр</h3><p>Балалар денсаулығы</p></div>
<div class="card spec-card"><h3>Невролог</h3><p>Жүйке жүйесі</p></div></div></section></div>
</main>
<?php include 'includes/footer.php'; ?>
