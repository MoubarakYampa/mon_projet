<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ZIKI Streaming</title>
  <style>
    :root {
      --background-color: #1e1e1e;
      --violet-principal: #4b0082;
      --violet-secondaire: #5e2ca5;
      --violet-clair-accent: #c77aff;
      --texte-principal: white;
      --texte-secondaire: #ccc;
    }
    html { scroll-behavior: smooth; }
    body { margin: 0; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background: var(--background-color); color: var(--texte-principal); }
    header { display: flex; justify-content: space-between; align-items: center; background: var(--violet-principal); padding: 0 2rem; position: fixed; top: 0; width: 100%; z-index: 1000; box-sizing: border-box; height: 70px; }
    .nav-left { display: flex; align-items: center; gap: 2rem; flex: 1; }
    #home-link { text-decoration: none; color: var(--texte-principal); }
    .nav-left strong { font-size: 1.8rem; font-weight: 900; letter-spacing: 2px; }
    .nav-left a { color: var(--texte-principal); text-decoration: none; font-weight: 500; transition: color 0.3s; }
    .nav-left a:hover { color: var(--violet-clair-accent); }
    .dropdown { position: relative; }
    .dropdown-content { display: none; position: absolute; top: 100%; left: 0; background: var(--violet-secondaire); padding: 0.5rem 0; border-radius: 5px; min-width: 160px; box-shadow: 0 3px 6px rgba(0,0,0,0.5); z-index: 200; }
    .dropdown:hover .dropdown-content { display: block; }
    .dropdown-content a { display: block; padding: 0.5rem 1rem; text-decoration: none; transition: background-color 0.3s, color 0.3s; color: var(--texte-principal); }
    .dropdown-content a:hover { background: var(--violet-clair-accent); color: var(--background-color); }
    .nav-right { display: flex; align-items: center; gap: 1rem; }
    .btn { border: none; border-radius: 50px; padding: 0.6rem 1.4rem; font-weight: 600; cursor: pointer; transition: all 0.3s ease; font-size: 0.95rem; user-select: none; }
    .btn-premium { background-color: var(--violet-clair-accent); color: var(--background-color); }
    .btn-premium:hover { background-color: #a051d9; color: var(--texte-principal); }
    .btn-login { background-color: transparent; color: var(--texte-principal); border: 2px solid var(--texte-principal); }
    .btn-login:hover { background-color: var(--violet-clair-accent); border-color: var(--violet-clair-accent); color: var(--background-color); }
    
    /* Main content styling */
    main { padding-top: 70px; min-height: 100vh; }
    .carousel { position: relative; height: 70vh; max-height: 800px; overflow: hidden; background-color: #000; }
    .carousel-images { display: flex; transition: transform 1s ease-in-out; height: 100%; }
    .carousel-slide { min-width: 100%; height: 100%; position: relative; }
    .carousel-slide img { width: 100%; height: 100%; object-fit: cover; filter: brightness(0.7); }
    .carousel-info { position: absolute; bottom: 40px; left: 40px; background: rgba(0,0,0,0.6); padding: 1.5rem; border-radius: 10px; max-width: 450px; }
    .carousel-info h1 { margin: 0 0 1rem; }
    .carousel-info p { font-size: 0.9rem; color: var(--texte-secondaire); max-height: 80px; overflow: hidden; text-overflow: ellipsis; }
    .play-btn { background: white; color: black; }
    .play-btn:hover { background: var(--violet-clair-accent); color: white; }
    .list-btn { background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.4); }
    .list-btn:hover { background: var(--violet-clair-accent); color: white; }
    .section { padding: 2rem 0; }
    .section h2, .page-title { margin-bottom: 1.5rem; padding: 0 2rem; font-size: 1.8rem; }
    .row-container { position: relative; }
    .row { display: flex; overflow-x: auto; scroll-behavior: smooth; gap: 1rem; padding-bottom: 1rem; padding-left: 2rem; padding-right: 2rem;}
    .row::-webkit-scrollbar { width: 8px; height: 8px; }
    .row::-webkit-scrollbar-track { background: transparent; }
    .row::-webkit-scrollbar-thumb { background: var(--violet-clair-accent); border-radius: 4px; }
    .card { flex: 0 0 auto; width: 200px; height: 300px; border-radius: 8px; overflow: hidden; background: #333; transition: transform 0.3s, box-shadow 0.3s; cursor: pointer; position: relative; }
    .card img { width: 100%; height: 100%; object-fit: cover; }
    .card:hover { transform: scale(1.05); box-shadow: 0 0 15px var(--violet-clair-accent); }
    .scroll-btn { position: absolute; top: 50%; transform: translateY(-50%); background: rgba(30,30,30,0.7); border: 1px solid rgba(255,255,255,0.2); color: white; font-size: 2rem; width: 50px; height: 50px; cursor: pointer; z-index: 5; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: background-color 0.3s; }
    .scroll-btn:hover { background-color: var(--violet-principal); }
    .scroll-left { left: 10px; }
    .scroll-right { right: 10px; }
    .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.85); z-index: 2000; display: none; justify-content: center; align-items: center; }
    .modal-content { background: var(--background-color); padding: 2rem; border-radius: 10px; width: 90%; max-width: 800px; display: flex; gap: 2rem; position: relative; }
    .modal-poster img { width: 250px; border-radius: 8px; }
    .modal-details h2 { margin-top: 0; color: var(--violet-clair-accent); }
    .modal-details p { color: var(--texte-secondaire); line-height: 1.6; }
    .modal-close { position: absolute; top: 15px; right: 15px; font-size: 2rem; color: white; cursor: pointer; border: none; background: none; }
    .rating { background: var(--violet-principal); padding: 0.3rem 0.8rem; border-radius: 20px; font-weight: bold; display: inline-block; margin-top: 1rem; }
    .grid-container { display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; padding: 0 2rem 2rem 2rem; }
    .person-card { text-align: center; color: var(--texte-secondaire); }
    .person-card .card-img-container { width: 200px; height: 300px; border-radius: 8px; overflow:hidden; background: #333; margin-bottom: 0.5rem; }
    .person-card p { margin: 0; font-weight: bold; color: var(--texte-principal); }

    /* --- NOUVEAU : FOOTER --- */
    footer {
        background-color: #111;
        color: var(--texte-secondaire);
        padding: 3rem 2rem;
        margin-top: 2rem;
        border-top: 2px solid var(--violet-principal);
    }
    .footer-container {
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 2rem;
    }
    .footer-column {
        flex: 1;
        min-width: 200px;
    }
    .footer-column h4 {
        color: var(--texte-principal);
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }
    .footer-column a {
        color: var(--texte-secondaire);
        text-decoration: none;
        display: block;
        margin-bottom: 0.5rem;
        transition: color 0.3s;
    }
    .footer-column a:hover {
        color: var(--violet-clair-accent);
    }
    .footer-socials a {
        margin-right: 1rem;
        font-size: 1.5rem;
    }
    .footer-bottom {
        text-align: center;
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #333;
    }
  </style>
</head>

<body>

<header>
  <div class="nav-left">
    <a href="#" id="home-link"><strong>ZIKI</strong></a>
    <div class="dropdown">
      <a href="#">Films ▼</a>
      <div class="dropdown-content">
        <a href="#" data-action="display-genre" data-id="28" data-name="Action">Action</a>
        <a href="#" data-action="display-genre" data-id="12" data-name="Aventure">Aventure</a>
        <a href="#" data-action="display-genre" data-id="16" data-name="Animation">Animation</a>
        <a href="#" data-action="display-genre" data-id="35" data-name="Comédie">Comédie</a>
        <a href="#" data-action="display-genre" data-id="80" data-name="Crime">Crime</a>
      </div>
    </div>
    <div class="dropdown">
       <a href="#">Découvrir ▼</a>
       <div class="dropdown-content">
          <a href="#" data-action="display-tv">Séries TV Populaires</a>
          <a href="#" data-action="display-people">Personnes Célèbres</a>
          <a href="#" data-action="display-discover" data-endpoint="/movie/top_rated" data-name="Films Mieux Notés">Mieux Notés</a>
          <a href="#" data-action="display-discover" data-endpoint="/movie/upcoming" data-name="Films À Venir">À Venir</a>
       </div>
    </div>
  </div>
  <div class="nav-right">
    <button class="btn btn-premium" data-action="premium">Premium</button>
    <div class="dropdown">
      <button class="btn btn-login">Se connecter ▼</button>
      <div class="dropdown-content">
        <a href="#" data-action="profile">Mon profil</a>
        <a href="#" data-action="settings">Paramètres</a>
        <a href="#" data-action="logout">Déconnexion</a>
      </div>
    </div>
  </div>
</header>

<main id="main-content"></main>

<div class="modal-overlay" id="movie-modal">
   <div class="modal-content">
    <button class="modal-close" id="modal-close-btn">&times;</button>
    <div class="modal-poster"> <img id="modal-poster-img" src="" alt="Affiche du film"> </div>
    <div class="modal-details">
      <h2 id="modal-title">Titre du Film</h2>
      <p id="modal-overview">Résumé du film...</p>
      <span class="rating" id="modal-rating">⭐ 0.0</span> <br><br>
      <button class="btn play-btn">▶ Lecture</button>
    </div>
  </div>
</div>

<footer>
  <div class="footer-container">
    <div class="footer-column">
      <h4>ZIKI Streaming</h4>
      <div class="footer-socials">
        <a href="#">FB</a> <a href="#">TW</a> <a href="#">IG</a>
      </div>
    </div>
    <div class="footer-column">
      <h4>Navigation</h4>
      <a href="#" id="home-link-footer">Accueil</a>
      <a href="#">Mon Compte</a>
      <a href="#">Aide</a>
    </div>
    <div class="footer-column">
      <h4>Légal</h4>
      <a href="#">Conditions d'utilisation</a>
      <a href="#">Politique de confidentialité</a>
      <a href="#">Mentions légales</a>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2025 ZIKI. Tous droits réservés.</p>
  </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {

  const API_KEY = '18b3bdaf25bf989226961ae11ca129c8'; // Remplacez par VOTRE clé API
  const API_BASE_URL = 'https://api.themoviedb.org/3';
  const IMAGE_BASE_URL = 'https://image.tmdb.org/t/p/original';
  const POSTER_BASE_URL = 'https://image.tmdb.org/t/p/w500';

  const homeSections = [
    { title: 'Tendances', endpoint: `/trending/movie/week`, id: 'tendances' },
    { title: 'Action', endpoint: `/discover/movie?with_genres=28`, id: 'action' },
    { title: 'Séries à l\'affiche', endpoint: `/tv/on_the_air`, id: 'tv_on_air' },
    { title: 'Horreur', endpoint: `/discover/movie?with_genres=27`, id: 'horror' },
  ];
  
  const mainContent = document.getElementById('main-content');
  
  // --- NOUVEAU : Variables pour le défilement infini ---
  let currentPage = 1;
  let currentEndpoint = '';
  let isLoading = false;
  let currentTitle = '';

  async function init() {
    await buildHomePage();
    setupEventListeners();
  }

  // --- Fonctions de construction de page ---
  async function buildHomePage() {
    clearInfiniteScroll();
    mainContent.innerHTML = ''; 
    const carouselContainer = document.createElement('div');
    carouselContainer.className = 'carousel';
    carouselContainer.innerHTML = '<div class="carousel-images" id="carousel-images"></div>';
    mainContent.appendChild(carouselContainer);
    
    const nowPlayingMovies = await fetchFromAPI(`/movie/now_playing`);
    if (nowPlayingMovies) populateCarousel(nowPlayingMovies.results.slice(0, 5));

    for (const section of homeSections) {
      const sectionEl = document.createElement('div');
      sectionEl.className = 'section';
      sectionEl.innerHTML = `<h2>${section.title}</h2><div class="row-container"><button class="scroll-btn scroll-left" data-target="${section.id}">‹</button><div class="row" id="${section.id}"></div><button class="scroll-btn scroll-right" data-target="${section.id}">›</button></div>`;
      mainContent.appendChild(sectionEl);
      
      const data = await fetchFromAPI(section.endpoint);
      if (data) createRow(data.results, section.id);
    }
  }

  async function buildGridPage(title, endpoint) {
      currentEndpoint = endpoint;
      currentTitle = title;
      currentPage = 1;
      mainContent.innerHTML = `<h2 class="page-title">${title}</h2><div class="grid-container" id="grid-container"></div>`;
      await loadMoreContent();
  }

  // --- NOUVEAU : Logique de défilement infini ---
  async function loadMoreContent() {
    if (isLoading || !currentEndpoint) return;
    isLoading = true;

    const gridContainer = document.getElementById('grid-container');
    const data = await fetchFromAPI(currentEndpoint, currentPage);

    if (data && data.results) {
        data.results.forEach(item => {
            let card;
            // Détermine quel type de carte créer (film, série, ou personne)
            if (item.media_type === 'person' || currentEndpoint.includes('/person')) {
                card = createPersonCard(item);
            } else {
                card = createMovieCard(item);
            }
            if (card) gridContainer.appendChild(card);
        });
        currentPage++;
    }
    isLoading = false;
  }
  
  function clearInfiniteScroll() {
      currentEndpoint = '';
      currentPage = 1;
  }

  window.addEventListener('scroll', () => {
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 500) {
          loadMoreContent();
      }
  });
  
  // --- Fonctions API ---
  async function fetchFromAPI(endpoint, page = 1) {
    const url = `${API_BASE_URL}${endpoint}?language=fr-FR&api_key=${API_KEY}&page=${page}`;
    try {
      const response = await fetch(url);
      if (!response.ok) throw new Error("Erreur réseau.");
      return await response.json();
    } catch (error) {
      console.error("Impossible de récupérer les données:", error);
      return null;
    }
  }

  async function fetchMovieDetails(movieId) {
    const url = `${API_BASE_URL}/movie/${movieId}?language=fr-FR&append_to_response=credits&api_key=${API_KEY}`;
    // ... reste de la fonction inchangée
    try {
      const response = await fetch(url);
      if (!response.ok) throw new Error("Erreur réseau.");
      return await response.json();
    } catch (error) {
      console.error(`Impossible de récupérer les détails pour ${movieId}:`, error);
      return null;
    }
  }

  // --- Fonctions d'affichage ---
  function populateCarousel(items) {
    const carouselContainer = document.getElementById('carousel-images');
    if (!carouselContainer) return;
    carouselContainer.innerHTML = '';
    items.forEach(item => {
      const title = item.title || item.name;
      const overview = item.overview;
      const slide = `<div class="carousel-slide"><img src="${IMAGE_BASE_URL}${item.backdrop_path}" alt="${title}" /><div class="carousel-info"><h1>${title}</h1><p>${overview}</p><button class="btn play-btn" data-movie-id="${item.id}">▶ Lecture</button></div></div>`;
      carouselContainer.innerHTML += slide;
    });
    startAutoCarousel();
  }
  
  function createRow(items, containerId) {
    const rowContainer = document.getElementById(containerId);
    if (!rowContainer) return;
    rowContainer.innerHTML = '';
    items.forEach(item => {
        const card = createMovieCard(item);
        if (card) rowContainer.appendChild(card);
    });
  }

  function createMovieCard(item) {
    if (!item.poster_path) return null;
    const card = document.createElement('div');
    card.className = 'card';
    card.dataset.movieId = item.id;
    card.dataset.mediaType = item.title ? 'movie' : 'tv';
    card.innerHTML = `<img src="${POSTER_BASE_URL}${item.poster_path}" alt="${item.title || item.name}" />`;
    return card;
  }
  
  function createPersonCard(person) {
    if (!person.profile_path) return null;
    const cardContainer = document.createElement('div');
    cardContainer.className = 'person-card';
    cardContainer.innerHTML = `
        <div class="card-img-container">
            <img src="${POSTER_BASE_URL}${person.profile_path}" alt="${person.name}" style="width:100%; height:100%; object-fit:cover;">
        </div>
        <p>${person.name}</p>
    `;
    return cardContainer;
  }

  async function showMovieModal(itemId, mediaType = 'movie') {
    const endpoint = `/${mediaType}/${itemId}?language=fr-FR&api_key=${API_KEY}`;
    const item = await fetchFromAPI(endpoint);
    if (!item) return;
    document.getElementById('modal-poster-img').src = `${POSTER_BASE_URL}${item.poster_path}`;
    document.getElementById('modal-title').textContent = item.title || item.name;
    document.getElementById('modal-overview').textContent = item.overview || "Résumé non disponible.";
    document.getElementById('modal-rating').innerHTML = `⭐ ${item.vote_average.toFixed(1)}`;
    document.getElementById('movie-modal').style.display = 'flex';
  }

  let carouselInterval;
  function startAutoCarousel() {
    const carousel = document.getElementById('carousel-images');
    const slides = document.querySelectorAll('.carousel-slide');
    if (!carousel || slides.length === 0) return;
    let currentIndex = 0;
    if(carouselInterval) clearInterval(carouselInterval);
    carouselInterval = setInterval(() => {
      currentIndex = (currentIndex + 1) % slides.length;
      carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
    }, 5000);
  }
  
  function hideMovieModal() {
    document.getElementById('movie-modal').style.display = 'none';
  }

  // --- Gestion des événements ---
  function setupEventListeners() {
    document.body.addEventListener('click', (event) => {
      const target = event.target;
      
      const card = target.closest('[data-movie-id]');
      if (card) {
        showMovieModal(card.dataset.movieId, card.dataset.mediaType);
        return;
      }
      
      const navLink = target.closest('[data-action]');
      if (navLink) {
          event.preventDefault();
          const { action, id, name, endpoint } = navLink.dataset;
          switch (action) {
              case 'display-genre':
                  buildGridPage(name, `/discover/movie?with_genres=${id}`);
                  break;
              case 'display-tv':
                  buildGridPage('Séries TV Populaires', '/tv/popular');
                  break;
              case 'display-people':
                  buildGridPage('Personnes Célèbres', '/person/popular');
                  break;
              case 'display-discover':
                  buildGridPage(name, endpoint);
                  break;
          }
          return;
      }

      const homeLink = target.closest('#home-link, #home-link-footer');
      if (homeLink) {
        event.preventDefault();
        buildHomePage();
      }
    });

    document.getElementById('modal-close-btn').addEventListener('click', hideMovieModal);
    document.getElementById('movie-modal').addEventListener('click', (event) => {
      if (event.target.id === 'movie-modal') hideMovieModal();
    });

    mainContent.addEventListener('click', (event) => {
      const scrollButton = event.target.closest('.scroll-btn');
      if (scrollButton) {
        const row = document.getElementById(scrollButton.dataset.target);
        if (row) {
          const scrollAmount = scrollButton.classList.contains('scroll-left') ? -row.clientWidth * 0.8 : row.clientWidth * 0.8;
          row.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
      }
    });
  }

  init();
});
</script>

</body>
</html>