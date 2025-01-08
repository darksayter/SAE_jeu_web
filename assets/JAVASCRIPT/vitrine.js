window.onload = function() {
    var element = document.getElementById("vitrine-paragraphy");
    var text = element.innerHTML; // Garder le HTML original
    var textLength = text.length;
    var currentChar = 0;
    var speed = 50;

    element.innerHTML = ""; // Vider l'élément pour commencer l'animation

    function typeWriter() {
        if (currentChar < textLength) {
            let char = text.charAt(currentChar);

            // Si c'est une balise HTML (comme <strong>, <br>, etc.), on la traite différemment
            if (char === "<") {
                let tag = "";
                // On va extraire la balise HTML complète
                while (char !== ">" && currentChar < textLength) {
                    tag += char;
                    currentChar++;
                    char = text.charAt(currentChar);
                }
                tag += ">";
                element.innerHTML += tag; // Ajouter la balise HTML complète sans l'animation
            } else {
                element.innerHTML += char; // Ajouter un caractère normal
            }

            currentChar++;
            setTimeout(typeWriter, speed);
        }
    }

    typeWriter();
};
