document.addEventListener("DOMContentLoaded", () => {
    const grid = document.getElementById("image-grid");

    const imageWidth = 900;
    const imageHeight = 600;
    const rows = 10;
    const cols = 10;
    const rectWidth = imageWidth / cols;
    const rectHeight = imageHeight / rows;

    for (let row = 0; row < rows; row++) {
        for (let col = 0; col < cols; col++) {
            const rect = document.createElement("div");
            rect.style.gridRow = row + 1;
            rect.style.gridColumn = col + 1;
            rect.style.backgroundImage = "url('assets/JAVASCRIPT/imagecamnoise.png')";
            rect.style.backgroundSize = `${imageWidth}px ${imageHeight}px`;
            rect.style.backgroundPosition = `-${col * rectWidth}px -${row * rectHeight}px`;
            rect.addEventListener('click', () => {
                // Retire la classe enlarged de toutes les cases sauf celle cliquée
                document.querySelectorAll('#image-grid div').forEach(div => {
                    if (div !== rect) {
                        div.classList.remove('enlarged');
                    }
                });
                // Ajuster transform-origin en fonction de la position de la case cliquée
                const originX = (col + 0.5) * rectWidth / imageWidth * 100;
                const originY = (row + 0.5) * rectHeight / imageHeight * 100;
                rect.style.transformOrigin = `${originX}% ${originY}%`;
                // Basculer la classe sur la case cliquée
                rect.classList.toggle('enlarged');
            });
            grid.appendChild(rect);
        }
    }

    const inputBox = document.createElement("input");
    const validateButton = document.createElement("button");
    inputBox.type = "text";
    inputBox.placeholder = "Entrez la bonne réponse";
    validateButton.textContent = "Valider";
    validateButton.addEventListener("click", () => {
        if (inputBox.value === "crypto_blog.fr") {
            alert("Bravo vous avez réussi !");
        } else {
            alert("Incorrect input. Please try again.");
        }
    });

    // Place inputBox under the div "image-grid" and the valid button at the end of the input box
    const container = document.createElement("div");
    container.style.display = "flex";
    
    container.style.alignItems = "center";
    container.style.marginTop = "20px";
    container.style.marginBottom = "20px";
    container.style.marginLeft = "auto";
    container.style.marginRight = "auto";
    container.appendChild(inputBox);
    container.appendChild(validateButton);
    grid.insertAdjacentElement('afterend', container);
});