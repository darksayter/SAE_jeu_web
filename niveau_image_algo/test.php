<?php
    include '../../header_e.php'; // Ton header de site d'énigmes
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />

    <style>
        /* Style général de la page */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #1e1e2e; /* Fond sombre pour un thème mystérieux */
            color: #eee;
        }

        /* Conteneur principal */
        .main-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #2c2f48; /* Couleur sombre */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        /* Style du mail */
        .email-header {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 15px;
            color: #ffcc00; /* Couleur dorée pour attirer l'œil */
        }

        .email-body {
            background-color: #333;
            padding: 15px;
            border-radius: 8px;
            color: #ddd;
            font-family: 'Courier New', Courier, monospace;
        }

        .email-body p {
            margin: 10px 0;
        }

		        /* Style pour la pièce jointe */
        .attachment {
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .attachment img {
            width: 50px;
            height: 50px;
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: transform 0.2s;
        }

        .attachment img:hover {
            transform: scale(1.1);
        }

        .attachment span {
            font-size: 1em;
            color: #aad4ff;
            text-decoration: underline;
        }

        /* Section cachée (compilateur) */
        .hidden-section {
            display: none;
            margin-top: 30px;
            background: #1b1b28;
            padding: 20px;
            border-radius: 8px;
        }

        canvas {
            border: 1px solid #ddd;
            max-width: 100%;
            margin: 20px auto;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            font-size: 1em;
            font-family: 'Courier New', Courier, monospace;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 15px;
        }

        button {
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #0078d7;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005bb5;
        }
    </style>
</head>
<body class = "body">
    <div class="main-container">
        <!-- Mail simulé -->
        <div class="email">
            <div class="email-header">De : mystere@enigme.com</div>
            <div class="email-body">
                <p>Nous avons reçu ce mail, il ne semble contenir aucune information mais étrangement, il est indiqué qu'il est envoyé à 25h32 et 25h33...</p>
                <p><strong>Matthieu, 25h32</strong></p>
                <p>Toutes les réponses se trouvent dans cette image.</p>
                <p><strong>Fin, 25h33</strong></p>

                <div class="attachment" onclick="revealCompiler()">
                    <img src="attachment_icon.png" alt="Pièce jointe" />
                    <span>[Télécharger la pièce jointe]</span>
                </div>
            </div>
        </div>

        <!-- Section cachée : Compilateur -->
        <div class="hidden-section" id="compilerSection">
            <h2>Compilateur d'algorithmes d'image</h2>
            <canvas id="imageCanvas"></canvas>
            <textarea id="codeInput" placeholder="Écrivez votre algorithme ici..."></textarea>

            <div>
                <h3>Exemple de Code :</h3>
                <div id="exampleCode">
                    for (let i = 0; i < pixels.length; i += 4) {<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;pixels[i] = 255 - pixels[i]; &nbsp;&nbsp;&nbsp;&nbsp;// Red<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;pixels[i + 1] = 255 - pixels[i + 1]; &nbsp;&nbsp;&nbsp;&nbsp;// Green<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;pixels[i + 2] = 255 - pixels[i + 2]; &nbsp;&nbsp;&nbsp;&nbsp;// Blue<br>
                    }
                </div>
            </div>

            <button id="executeButton">Exécuter</button>
            <img id="outputImage" />
        </div>
    </div>

    <!-- Script -->
    <script>
        // Révéler le compilateur d'image lorsque la pièce jointe est cliquée
        function revealCompiler() {
            const compilerSection = document.getElementById("compilerSection");
            compilerSection.style.display = "block";

            // Charger automatiquement l'image par défaut
            const img = new Image();
            img.src = "image_modifiee.png"; // Chemin direct vers l'image
            img.onload = function() {
                const canvas = document.getElementById("imageCanvas");
                const ctx = canvas.getContext("2d");
                canvas.width = img.width;
                canvas.height = img.height;
                ctx.drawImage(img, 0, 0);
            };
        }

        // Code pour exécuter l'algorithme sur l'image
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
    </script>
</body>
<?php
    include '../../footer_e.php'; // Ton footer de site d'énigmes
?>
