<!DOCTYPE html>
<html lang="kk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Басты бет | Dr.tirkelu</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header><div class="container">
<a class="logo" href="index.html">Dr.<span>tirkelu</span></a>
<button class="burger" aria-label="Мәзір" aria-expanded="false">☰</button>
<nav><ul><li><a href="index.html" aria-current="page">Басты бет</a></li><li><a href="doctors.html">Дәрігерлер</a></li><li><a href="login.html">Кіру</a></li><li><a class="btn" href="register.html">Тіркелу</a></li></ul></nav>
</div></header>
<main>
<div class="hero-band"><div class="container hero">
<div><h1>Дәрігерге жазылу — бірнеше секундта</h1>
<p>Дәрігерді таңдаңыз, бос уақытты көріңіз, кезекте тұрмай жазылыңыз.</p>
<div class="hero-actions"><a class="btn white" href="doctors.html">Дәрігерге жазылу</a><a class="btn black" href="register.html">Тіркелу</a><a class="btn outline-w" href="login.html">Кіру</a></div></div>
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
<footer><div class="container">© 2026 MedJazu — дәрігерге онлайн жазылу жүйесі</div></footer>
<script src="js/script.js"></script>
</body>
</html>