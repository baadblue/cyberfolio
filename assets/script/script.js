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

// Mettre à jour le lien actif lors du clic
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        // Retirer la classe active de tous les liens
        document.querySelectorAll('nav .menu li a, .sidebar_menu li a')
            .forEach(link => link.classList.remove('active'));
        
        // Ajouter la classe active au lien cliqué
        this.classList.add('active');
        
        // Faire défiler jusqu'à la section
        const section = document.querySelector(this.getAttribute('href'));
        section.scrollIntoView({
            behavior: 'smooth'
        });
    });
});