// 1. Бургер мәзір
const burger=document.querySelector('.burger'),menu=document.querySelector('nav ul');
if(burger)burger.addEventListener('click',()=>{const o=menu.classList.toggle('open');burger.setAttribute('aria-expanded',o)});

// 2. Уақыт слотын таңдау (басты бет)
const slots=document.querySelectorAll('.slot:not(.busy)'),msg=document.getElementById('slot-msg');
slots.forEach(s=>s.addEventListener('click',()=>{
  slots.forEach(x=>x.classList.remove('selected'));s.classList.add('selected');
  msg.textContent='Таңдалды: ертең, '+s.textContent+'. Жазылу үшін жүйеге кіріңіз.';
}));

// 3. Құпия сөзді көрсету/жасыру
document.querySelectorAll('.pw button').forEach(b=>b.addEventListener('click',()=>{
  const i=b.previousElementSibling,show=i.type==='password';
  i.type=show?'text':'password';b.textContent=show?'Жасыру':'Көрсету';
}));

// 4. Форманы клиенттік тексеру
const form=document.querySelector('form[data-validate]');
if(form)form.addEventListener('submit',e=>{
  let ok=true;
  const fail=(el,t)=>{el.classList.add('invalid');const er=el.closest('div.field').querySelector('.error');er.textContent=t;ok=false};
  form.querySelectorAll('.invalid').forEach(i=>i.classList.remove('invalid'));
  form.querySelectorAll('.error').forEach(x=>x.textContent='');
  const f=n=>form.elements[n];
  if(f('full_name')&&f('full_name').value.trim().length<3)fail(f('full_name'),'Аты-жөніңізді толық жазыңыз');
  if(f('phone')&&!/^\+?\d{10,12}$/.test(f('phone').value.replace(/[\s()-]/g,'')))fail(f('phone'),'Телефон нөмірін дұрыс енгізіңіз');
  if(!f('email').validity.valid)fail(f('email'),'Email дұрыс емес');
  if(f('password').value.length<8)fail(f('password'),'Құпия сөз кемінде 8 таңба болуы керек');
  if(f('password2')&&f('password2').value!==f('password').value)fail(f('password2'),'Құпия сөздер сәйкес емес');
  if(!ok)e.preventDefault();
  else{e.preventDefault();alert('Форма дұрыс толтырылды. PHP-мен байланыстыру келесі аптада.');}
});

// 5. Дәрігерлерді іздеу және сүзу
const q=document.getElementById('search'),sp=document.getElementById('specialty'),cards=document.querySelectorAll('.doctor');
function filter(){
  const t=q.value.toLowerCase(),s=sp.value;let n=0;
  cards.forEach(c=>{const show=c.dataset.name.toLowerCase().includes(t)&&(!s||c.dataset.spec===s);c.hidden=!show;if(show)n++});
  document.getElementById('empty').hidden=n>0;
}
if(q){q.addEventListener('input',filter);sp.addEventListener('change',filter)}
