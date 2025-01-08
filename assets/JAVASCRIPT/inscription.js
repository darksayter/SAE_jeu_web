console.log("Le script inscription.js est chargé.");

document.addEventListener('DOMContentLoaded', () => {
    const avatars = [
        'assets/IMAGES/user_profil.png',
        'assets/IMAGES/askey.png',
    ];
    
    let currentIndex = 0;

    // Références des éléments
    const avatarImage = document.getElementById('avatar-image');
    const prevButton = document.getElementById('prev-avatar');
    const nextButton = document.getElementById('next-avatar');

    // Fonction pour mettre à jour l'avatar
    const updateAvatar = () => {
        avatarImage.src = avatars[currentIndex];
    };

    // Gestion des événements sur les boutons
    prevButton.addEventListener('click', (event) => {
        event.preventDefault(); // Empêche le comportement par défaut
        currentIndex = (currentIndex - 1 + avatars.length) % avatars.length; // Retourne au dernier si < 0
        updateAvatar();
    });

    nextButton.addEventListener('click', (event) => {
        event.preventDefault(); // Empêche le comportement par défaut
        currentIndex = (currentIndex + 1) % avatars.length; // Retourne au premier si dépasse
        updateAvatar();
    });

    // Initialisation
    updateAvatar();
});