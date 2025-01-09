const menu = document.querySelector('.sidebar_menu')
const open_menu = document.querySelector('#open_menu')
const close_menu = document.querySelector('#close_menu')

open_menu.addEventListener('click', function(){
    menu.classList.add('active')
})

close_menu.addEventListener('click', function(){
    menu.classList.remove('active')
})

// Modifier le défilement fluide pour prendre en compte la navbar
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const section = document.querySelector(this.getAttribute('href'));
        const navbarHeight = document.querySelector('.navbar').offsetHeight;
        const targetPosition = section.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
        
        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
        
        // Fermer le menu sidebar si ouvert (pour mobile)
        const menu = document.querySelector('.sidebar_menu');
        if (menu.classList.contains('active')) {
            menu.classList.remove('active');
        }
    });
});

// Ajout de l'effet de parallaxe sur le héro
window.addEventListener('scroll', () => {
    const heroSection = document.querySelector('.hero-section');
    const scrolled = window.pageYOffset;
    heroSection.style.backgroundPositionY = scrolled * 0.5 + 'px';
});

// Ajout de la gestion des liens actifs
function setActiveLink() {
    // Récupérer tous les liens de navigation
    const navLinks = document.querySelectorAll('nav .menu li a, .sidebar_menu li a');
    
    // Récupérer toutes les sections
    const sections = document.querySelectorAll('section');
    
    // Récupérer la position actuelle du scroll avec une marge
    const scrollPosition = window.scrollY + window.innerHeight / 3;
    
    // Vérifier chaque section
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        
        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            const currentId = section.getAttribute('id');
            
            // Retirer la classe active de tous les liens
            navLinks.forEach(link => {
                link.classList.remove('active');
            });
            
            // Ajouter la classe active aux liens correspondants
            document.querySelectorAll(`a[href="#${currentId}"]`).forEach(link => {
                link.classList.add('active');
            });
        }
    });
}

// Écouter le scroll pour mettre à jour le lien actif
window.addEventListener('scroll', setActiveLink);

// Exécuter une fois au chargement de la page
document.addEventListener('DOMContentLoaded', setActiveLink);

const BREACHES_URL = 'https://haveibeenpwned.com/api/v3/breaches';

async function fetchLatestBreach() {
  const securityBreachDiv = document.getElementById('security-breach');

  try {
    // Récupération des données via l'API
    const response = await fetch(BREACHES_URL);

    if (!response.ok) {
      throw new Error(`Erreur API : ${response.status}`);
    }

    const breaches = await response.json();

    // Tri des données par date (si disponible) pour obtenir la plus récente
    breaches.sort((a, b) => new Date(b.BreachDate) - new Date(a.BreachDate));

    // Sélection de la dernière faille
    const latestBreach = breaches[0];

    // Affichage des informations
    securityBreachDiv.innerHTML = `
      <p class="response"><strong>Dernière faille de sécurité :</strong> ${latestBreach.Title}</p>
      <p class="response"><strong>Date :</strong> ${new Date(latestBreach.BreachDate).toLocaleDateString()}</p>
      <p class="response"><strong>Description :</strong> ${latestBreach.Description}</p>
      <p class="response"><strong>Données compromises :</strong> ${latestBreach.DataClasses.join(', ')}</p>
    `;
  } catch (error) {
    // Gestion des erreurs
    securityBreachDiv.innerHTML = `
      <p>Une erreur s'est produite lors de la récupération des données : ${error.message}</p>
    `;
    console.error(error);
  }
}

// Appeler la fonction au chargement de la page
fetchLatestBreach();

document.getElementById('hashForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const hashInput = document.getElementById('hashInput').value;
    const resultDiv = document.getElementById('hashResult');

    console.log(hashInput);
    
    try {
        const response = await fetch('detect_hash.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `hash=${encodeURIComponent(hashInput)}`
        });
        
        const data = await response.json();
        
        if (data.error) {
            resultDiv.innerHTML = `<p class="error">${data.error}</p>`;
        } else {
            resultDiv.innerHTML = `w
                <p class="response">Longueur : ${data.length} caractères</p>
                <p class="response">Types possibles : ${data.possible_types.join(', ')}</p>
            `;
        }
    } catch (error) {
        resultDiv.innerHTML = '<p class="error">Erreur lors de la détection du hash</p>';
        console.error(error);
    }
});