document.getElementById("imageInput").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.src = e.target.result;
            img.onload = function() {
                const canvas = document.getElementById("imageCanvas");
                const ctx = canvas.getContext("2d");
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
            }
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById("executeButton").addEventListener("click", function() {
    const code = document.getElementById("codeInput").value; // Code de l'utilisateur
    const canvas = document.getElementById("imageCanvas");
    const ctx = canvas.getContext("2d");

    // Récupération de l'image
    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const pixels = imageData.data;

    // Compiler le code de l'utilisateur
    try {
        const userCodeFunction = new Function('pixels', `
            ${code}
            return pixels;
        `);

        const modifiedPixels = userCodeFunction(pixels);

        for (let i = 0; i < modifiedPixels.length; i++) {
            pixels[i] = modifiedPixels[i];
        }

        ctx.putImageData(imageData, 0, 0);
        document.getElementById("outputImage").src = canvas.toDataURL();

    } catch (error) {
        alert("Erreur dans le code de l'algorithme : " + error.message);
    }
});
