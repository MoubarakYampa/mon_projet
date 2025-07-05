<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ZIKI Streaming</title>
  <style>
  
    /* Reset & basics */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #1e1e1e;
      color: white;
      overflow-x: hidden;
    }

    /* HEADER */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #4b0082; /* violet foncé */
      padding: 1.5rem 2rem; /* plus épais */
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 100;
      box-sizing: border-box;
      height: 70px;
    }

    /* Logo à gauche */
    .nav-left {
      display: flex;
      align-items: center;
      gap: 2rem;
      flex: 1;
    }

    .nav-left strong {
      font-size: 1.8rem;
      font-weight: 900;
      letter-spacing: 2px;
      cursor: default;
    }

    .nav-left a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      position: relative;
      padding: 0.2rem 0;
      transition: color 0.3s;
    }

    .nav-left a:hover,
    .nav-left .dropdown > a:hover {
      color: #c77aff; /* violet clair */
    }

    /* Dropdown */
    .dropdown {
      position: relative;
      cursor: pointer;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      top: 36px;
      left: 0;
      background: #5e2ca5;
      padding: 0.5rem 0;
      border-radius: 5px;
      min-width: 130px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.5);
      z-index: 200;
    }

    .dropdown-content a {
      display: block;
      padding: 0.5rem 1rem;
      color: white;
      font-weight: 400;
      transition: background-color 0.3s;
    }

    .dropdown-content a:hover {
      background: #c77aff;
      color: #1e1e1e;
    }

    

    /* Nav droite */
    .nav-right {
      display: flex;
      align-items: center;
      gap: 1rem;
      flex-shrink: 0;
    }

    /* Boutons Premium et Se connecter */
    .btn {
      border: none;
      border-radius: 50px;
      padding: 0.5rem 1.3rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
      font-size: 1rem;
      user-select: none;
    }

    .btn-premium {
      background-color: #c77aff;
      color: #1e1e1e;
    }
    .btn-premium:hover {
      background-color: #a051d9;
      color: white;
    }

    /* Dropdown pour Se connecter */
    .dropdown-login {
      position: relative;
    }

    .btn-login {
      background-color: transparent;
      color: white;
      border: 2px solid white;
      padding: 0.5rem 1.2rem;
      border-radius: 50px;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.3rem;
      transition: all 0.3s ease;
      user-select: none;
    }
    .btn-login:hover {
      background-color: #c77aff;
      border-color: #c77aff;
      color: #1e1e1e;
    }

    /* Sous menu pour se connecter */
    .dropdown-login-content {
      display: none;
      position: absolute;
      top: 42px;
      right: 0;
      background: #5e2ca5;
      border-radius: 6px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.6);
      padding: 0.5rem 0;
      min-width: 140px;
      z-index: 300;
    }

    .dropdown-login-content a {
      display: block;
      padding: 0.5rem 1rem;
      color: white;
      font-weight: 400;
      text-align: left;
      text-decoration: none;
      transition: background-color 0.3s;
    }
    .dropdown-login-content a:hover {
      background: #c77aff;
      color: #1e1e1e;
    }

    .dropdown-login:hover .dropdown-login-content {
      display: block;
    }
    .dropdown:hover .dropdown-content,
.dropdown-content:hover {
  display: block;
}

    /* Carousel */
    .carousel {
      margin-top: 70px;
      position: relative;
      height: 800px;
      overflow: hidden;
    }

    .carousel-images {
      display: flex;
      transition: transform 1s ease-in-out;
      height: 100%;
    }

    .carousel-slide {
      min-width: 100%;
      height: 100%;
      position: relative;
      user-select: none;
    }

    .carousel-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      pointer-events: none;
    }

    .carousel-info {
      position: absolute;
      bottom: 20px;
      left: 40px;
      background: rgba(0,0,0,0.5);
      padding: 1rem;
      border-radius: 10px;
      max-width: 300px;
      user-select: text;
    }

    .carousel-info h1 {
      margin: 0 0 0.5rem;
    }

    .carousel-info button {
      margin-right: 1rem;
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
      transition: background-color 0.3s, color 0.3s;
    }

    .play-btn {
      background: white;
      color: black;
    }
    .play-btn:hover {
      background: #c77aff;
      color: white;
    }

    .list-btn {
      background: rgba(255,255,255,0.2);
      color: white;
    }
    .list-btn:hover {
      background: #c77aff;
      color: white;
    }

    /* Sections */
    .section {
      padding: 2rem;
    }

    .section h2 {
      margin-bottom: 1rem;
    }

    /* Carousel horizontal pour les vidéos (cards) */
    .row-container {
      position: relative;
    }

    .row {
      display: flex;
      overflow-x: auto;
      scroll-behavior: smooth;
      gap: 1rem;
      padding-bottom: 1rem;
    }

    .card {
      flex: 0 0 auto;
      width: 180px;
      height: 260px;
      border-radius: 10px;
      overflow: hidden;
      background: #333;
      transition: transform 0.3s;
      cursor: pointer;
    }

    .card img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      user-select: none;
    }

    .card:hover {
      transform: scale(1.05);
      filter: drop-shadow(0 0 6px #c77aff);
    }

    /* Boutons de scroll pour les lignes */
    .scroll-btn {
      position: absolute;
      top: 40%;
      transform: translateY(-50%);
      background: rgba(75,0,130,0.8);
      border: none;
      color: white;
      font-size: 2rem;
      padding: 0.2rem 0.5rem;
      cursor: pointer;
      z-index: 5;
      border-radius: 5px;
      user-select: none;
      transition: background-color 0.3s;
    }

    .scroll-btn:hover {
      background-color: #a051d9;
    }

    .scroll-left {
      left: 0;
    }

    .scroll-right {
      right: 0;
    }

    /* Scrollbar custom (facultatif) */
    .row::-webkit-scrollbar {
      height: 8px;
    }

    .row::-webkit-scrollbar-track {
      background: #2a2a2a;
      border-radius: 4px;
    }

    .row::-webkit-scrollbar-thumb {
      background: #c77aff;
      border-radius: 4px;
    }
  </style>
</head>

<body>

<header>
  <div class="nav-left">
    <strong>ZIKI</strong>
    <a href="#">Films</a>
    <a href="#">Séries</a>
    <div class="dropdown">
      <a href="#">Catégories ▼</a>
      <div class="dropdown-content">
        <nav class="categories">
  <a href="#">Action</a>
  <a href="#">Aventure</a>
  <a href="#">Animation</a>
  <a href="#">Comédie</a>
  <a href="#">Crime</a>
  <a href="#">Documentaire</a>
  <a href="#">Drame</a>
  <a href="#">Familial</a>
  <a href="#">Fantastique / Fantasy</a>
  <a href="#">Horreur</a>
  <a href="#">Musical</a>
  <a href="#">Mystère</a>
  <a href="#">Romance</a>
  <a href="#">Science-fiction</a>
  <a href="#">Suspense / Thriller</a>
  <a href="#">Guerre</a>
  <a href="#">Western</a>
  <a href="#">Films étrangers</a>
  <a href="#">Classiques</a>
  <a href="#">Films pour enfants</a>
  <a href="#">Films africains</a>
  <a href="#">Mangas / Anime</a>
  <a href="#">Séries TV populaires</a>
  <a href="#">Séries originales (exclusivités)</a>
</nav>

      </div>
    </div>
  </div>
  <div class="nav-right">
    <button class="btn btn-premium">Premium</button>

    <div class="dropdown-login">
      <button class="btn-login">Se connecter ▼</button>
      <div class="dropdown-login-content">
        <a href="#">Mon profil</a>
        <a href="#">Paramètres</a>
        <a href="#">Déconnexion</a>
      </div>
    </div>
  </div>
</header>

<div class="carousel" aria-label="Carrousel de vidéos">
  <div class="carousel-images" id="carousel">
    <div class="carousel-slide">
      <img src="https://source.unsplash.com/1600x400/?african,film" alt="Image du film Rebellion" />
      <div class="carousel-info">
        <h1>Rebellion</h1>
        <button class="play-btn">▶ Lecture</button>
        <button class="list-btn">+ Ma Liste</button>
      </div>
    </div>
    <div class="carousel-slide">
      <img src="https://source.unsplash.com/1600x400/?cinema" alt="Image La Scène" />
      <div class="carousel-info">
        <h1>La Scène</h1>
        <button class="play-btn">▶ Lecture</button>
        <button class="list-btn">+ Ma Liste</button>
      </div>
    </div>
    <div class="carousel-slide">
      <img src="https://source.unsplash.com/1600x400/?netflix" alt="Image Original ZIKI" />
      <div class="carousel-info">
        <h1>Original ZIKI</h1>
        <button class="play-btn">▶ Lecture</button>
        <button class="list-btn">+ Ma Liste</button>
      </div>
    </div>
  </div>
</div>

<div class="section">
  <h2>Tendances</h2>
  <div class="row-container">
    <button class="scroll-btn scroll-left" onclick="scrollRow('tendances', -300)">‹</button>
    <div class="row" id="tendances" tabindex="0" aria-label="Liste des films tendances">
      <div class="card"><img src="https://source.unsplash.com/200x300/?movie" alt="Film 1" /></div>
      <div class="card"><img src="https://source.unsplash.com/200x300/?film" alt="Film 2" /></div>
      <div class="card"><img src="https://source.unsplash.com/200x300/?cinema" alt="Film 3" /></div>
      <div class="card"><img src="https://source.unsplash.com/200x300/?action" alt="Film 4" /></div>
    </div>
    <button class="scroll-btn scroll-right" onclick="scrollRow('tendances', 300)">›</button>
  </div>
</div>

<div class="section">
  <h2>Comédies</h2>
  <div class="row-container">
    <button class="scroll-btn scroll-left" onclick="scrollRow('comedies', -300)">‹</button>
    <div class="row" id="comedies" tabindex="0" aria-label="Liste des comédies">
      <div class="card"><img src="https://source.unsplash.com/200x300/?comedy" alt="Comédie 1" /></div>
      <div class="card"><img src="https://source.unsplash.com/200x300/?funny" alt="Comédie 2" /></div>
      <div class="card"><img src="https://source.unsplash.com/200x300/?laugh" alt="Comédie 3" /></div>
      <div class="card"><img src="https://source.unsplash.com/200x300/?tv" alt="Comédie 4" /></div>
    </div>
    <button class="scroll-btn scroll-right" onclick="scrollRow('comedies', 300)">›</button>
  </div>
</div>

<script>
  // Auto slide carousel
  let currentIndex = 0;
  const carousel = document.getElementById('carousel');
  const slides = document.querySelectorAll('.carousel-slide');

  setInterval(() => {
    currentIndex = (currentIndex + 1) % slides.length;
    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
  }, 5000);

  // Scroll horizontal rows
  function scrollRow(id, amount) {
    document.getElementById(id).scrollBy({
      left: amount,
      behavior: 'smooth'
    });
  }
</script>
<script>
  const dropdown = document.querySelector('.dropdown');
  const dropdownContent = document.querySelector('.dropdown-content');
  let timeoutId = null;

  function showMenu() {
    if (timeoutId) {
      clearTimeout(timeoutId);
      timeoutId = null;
    }
    dropdownContent.style.display = 'block';
  }

  function hideMenu(delay = 0) {
    if (timeoutId) clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      dropdownContent.style.display = 'none';
      timeoutId = null;
    }, delay);
  }

  // Afficher menu au survol du parent ou du contenu
  dropdown.addEventListener('mouseenter', showMenu);
  dropdownContent.addEventListener('mouseenter', showMenu);

  // Cacher menu quand la souris quitte le parent ou le contenu
  dropdown.addEventListener('mouseleave', () => hideMenu(0));
  dropdownContent.addEventListener('mouseleave', () => hideMenu(0));

  // Au clic sur un lien, garder affiché puis cacher au bout de 3s
  dropdownContent.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault(); // si tu veux que le lien ne navigue pas
      showMenu();
      hideMenu(3000);
    });
  });
</script>
<script>
  const dropdown = document.querySelector('.dropdown');
  const dropdownContent = document.querySelector('.dropdown-content');
  let timeoutId = null;

  // Affiche au clic
  dropdown.querySelector('a').addEventListener('click', (e) => {
    e.preventDefault();
    if (dropdownContent.style.display === 'block') {
      dropdownContent.style.display = 'none';
      if (timeoutId) {
        clearTimeout(timeoutId);
        timeoutId = null;
      }
    } else {
      dropdownContent.style.display = 'block';
      if (timeoutId) {
        clearTimeout(timeoutId);
        timeoutId = null;
      }
    }
  });

  // Quand la souris quitte le menu ou le bouton, on lance le timer de 3s pour cacher
  function startHideTimer() {
    if (timeoutId) clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
      dropdownContent.style.display = 'none';
      timeoutId = null;
    }, 3000);
  }

  dropdown.addEventListener('mouseleave', startHideTimer);
  dropdownContent.addEventListener('mouseleave', startHideTimer);

  // Si la souris revient sur le bouton ou menu, on annule la disparition
  dropdown.addEventListener('mouseenter', () => {
    if (timeoutId) {
      clearTimeout(timeoutId);
      timeoutId = null;
    }
  });
  dropdownContent.addEventListener('mouseenter', () => {
    if (timeoutId) {
      clearTimeout(timeoutId);
      timeoutId = null;
    }
  });
</script>



</body>
</html>

