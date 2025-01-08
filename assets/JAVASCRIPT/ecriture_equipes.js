const textElement = document.getElementById("text");

const message = "Equipes"; // Ici pour modifier le message que vous voulez afficher

textElement.style.fontSize = "100px"; // Ici modifier la taille de "TITRE"

let index = 0;

function typeLetter() {
    if (index < message.length) {
        textElement.textContent += message[index];
        index++;
        setTimeout(typeLetter, 100); // Modifiez le "100" pour changer le temps que les lettres apparaissent 
                                            // + le chiffre est petit plus ca ira vite 
                                            // + le chiffre est grand plus ca ira lentement
    }
}

typeLetter();
