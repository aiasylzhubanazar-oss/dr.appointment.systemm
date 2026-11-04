<!DOCTYPE html>
<html lang="kk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Дәрігерлер | Dr.tirkelu</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<header><div class="container">
<a class="logo" href="index.html">Dr.<span>tirkelu</span></a>
<button class="burger" aria-label="Мәзір" aria-expanded="false">☰</button>
<nav><ul><li><a href="index.html">Басты бет</a></li><li><a href="doctors.html" aria-current="page">Дәрігерлер</a></li><li><a href="login.html">Кіру</a></li><li><a class="btn" href="register.html">Тіркелу</a></li></ul></nav>
</div></header>
<main class="container"><section><h1 class="title">Дәрігерлер</h1>
<div class="filters"><input id="search" type="search" placeholder="Дәрігердің аты бойынша іздеу" aria-label="Іздеу">
<select id="specialty" aria-label="Мамандық"><option value="">Барлық мамандық</option><option>Терапевт</option><option>Кардиолог</option><option>Педиатр</option><option>Невролог</option></select></div>
<div class="grid"><article class="card doctor" data-name="Сымбат Үсен" data-spec="Терапевт"><div class="avatar" aria-hidden="true">СҮ</div><h3>Сымбат Үсен</h3><div class="spec">Терапевт</div><p>12 жыл тәжірибе. Жалпы қабылдау, тексеру, ем тағайындау.</p><a class="btn" href="login.html">Жазылу</a></article>
<article class="card doctor" data-name="Аян Әлмұханқызы" data-spec="Кардиолог"><div class="avatar" aria-hidden="true">ЕС</div><h3>Аян Әлмұханқызы</h3><div class="spec">Кардиолог</div><p>Жүрек-қан тамыр аурулары, ЭКГ, қан қысымын бақылау.</p><a class="btn" href="login.html">Жазылу</a></article>
<article class="card doctor" data-name="Азиз Жұмамұратов" data-spec="Педиатр"><div class="avatar" aria-hidden="true">ДҚ</div><h3>Азиз Жұмамұратов</h3><div class="spec">Педиатр</div><p>Балалар денсаулығы, вакцинация, өсу мен дамуды бақылау.</p><a class="btn" href="login.html">Жазылу</a></article>
<article class="card doctor" data-name="Нурасыл Танатов" data-spec="Невролог"><div class="avatar" aria-hidden="true">МЖ</div><h3>Нурасыл Танатов</h3><div class="spec">Невролог</div><p>Бас ауруы, ұйқы бұзылуы, жүйке жүйесі.</p><a class="btn" href="login.html">Жазылу</a></article>
<article class="card doctor" data-name="Арайлым Әбджаппарқызы" data-spec="Терапевт"><div class="avatar" aria-hidden="true">СА</div><h3>Арайлым Әбджаппарқызы</h3><div class="spec">Терапевт</div><p>Қайталама қабылдау, анализдерді талдау.</p><a class="btn" href="login.html">Жазылу</a></article>
</div>
<p id="empty" hidden>Дәрігер табылмады. Іздеу сөзін немесе мамандықты өзгертіңіз.</p></section></main>
<footer><div class="container">© 2026 dr.tirkelu — дәрігерге онлайн жазылу жүйесі</div></footer>
<script src="js/script.js"></script>
</body>
</html>