<?php
    include '../../header_e.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #000;
      color: #fff;
      text-align: center;
      margin: 0;
      padding: 0;
    }

    h1 {
      margin-top: 20px;
    }

    #message-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 300px;
      overflow: hidden;
      position: relative;
    }

    .char {
      font-size: 30px;
      font-weight: bold;
      position: absolute;
      transition: all 0.1s linear;
      transform-origin: center center;
      pointer-events: none;
    }

    .slider-container {
      margin: 10px;
    }

    .slider {
      width: 300px;
    }
  </style>
</head>
<body>
  <h1>Révélez le message caché</h1>
  <div id="message-container"></div>

  <div class="slider-container">
    <label for="horizontal-slider">Curseur horizontal</label><br>
    <input id="horizontal-slider" class="slider" type="range" min="0" max="100" step="1">
  </div>

  <div class="slider-container">
    <label for="vertical-slider">Curseur vertical</label><br>
    <input id="vertical-slider" class="slider" type="range" min="0" max="100" step="1">
  </div>

  <div class="slider-container">
    <label for="visibility-slider">Curseur de visibilité</label><br>
    <input id="visibility-slider" class="slider" type="range" min="0" max="100" step="1">
  </div>

  <div class="slider-container">
    <label for="deformation-slider">Curseur de déformation</label><br>
    <input id="deformation-slider" class="slider" type="range" min="0" max="100" step="1">
  </div>

  <script>
    const message = "Ceci est le message caché";
    const container = document.getElementById('message-container');
    const horizontalSlider = document.getElementById('horizontal-slider');
    const verticalSlider = document.getElementById('vertical-slider');
    const visibilitySlider = document.getElementById('visibility-slider');
    const deformationSlider = document.getElementById('deformation-slider');

    // Variables cibles aléatoires pour les curseurs
    const targetHorizontal = Math.random() * 100;
    const targetVertical = Math.random() * 100;
    const targetVisibility = Math.random() * 100;
    const targetDeformation = Math.random() * 100;
    const tolerance = 5;

    // Création des caractères déformés
    const chars = message.split('');
    chars.forEach((char, index) => {
      const span = document.createElement('span');
      span.textContent = char;
      span.classList.add('char');

      // Position aléatoire initiale
      span.style.left = `${Math.random() * 100}vw`;
      span.style.top = `${Math.random() * 100}vh`;

      // Couleur et déformation initiales
      span.style.opacity = 0;
      span.style.transform = `rotate(${Math.random() * 360}deg) scaleX(${Math.random() * 0.5 + 0.5})`;

      container.appendChild(span);
    });

    function updatePositions() {
      const horizontalValue = horizontalSlider.value;
      const verticalValue = verticalSlider.value;
      const visibilityValue = visibilitySlider.value;
      const deformationValue = deformationSlider.value;

      const characters = document.querySelectorAll('.char');
      characters.forEach((char, index) => {
        const baseX = index * 30 + 100; // Position horizontale de base
        const baseY = 150;             // Position verticale de base

        // Calcul des décalages
        const offsetX = (horizontalValue - targetHorizontal) * (Math.random() - 0.5) * 20;
        const offsetY = (verticalValue - targetVertical) * (Math.random() - 0.5) * 20;
        const visibilityDelta = Math.abs(visibilityValue - targetVisibility);
        const deformationDelta = Math.abs(deformationValue - targetDeformation);

        // Appliquer des transformations non linéaires
        const opacity = Math.max(0, 1 - Math.pow(visibilityDelta / 20, 2.5));
        const rotation = deformationDelta * 3; // Rotation amplifiée
        const scaleX = 1 - Math.min(Math.pow(deformationDelta / 50, 2), 0.9); // Écrasement amplifié

        // Application des transformations
        char.style.left = `${baseX + offsetX}px`;
        char.style.top = `${baseY + offsetY}px`;
        char.style.transform = `rotate(${rotation}deg) scaleX(${scaleX})`;
        char.style.opacity = opacity;

        // Vérifier si la lettre est parfaitement alignée
        if (
          Math.abs(horizontalValue - targetHorizontal) <= tolerance &&
          Math.abs(verticalValue - targetVertical) <= tolerance &&
          visibilityDelta <= tolerance &&
          deformationDelta <= tolerance
        ) {
          char.style.left = `${baseX}px`;
          char.style.top = `${baseY}px`;
          char.style.transform = `rotate(0deg) scaleX(1)`;
          char.style.opacity = 1;
        }
      });
    }

    // Écouteurs pour les sliders
    horizontalSlider.addEventListener('input', updatePositions);
    verticalSlider.addEventListener('input', updatePositions);
    visibilitySlider.addEventListener('input', updatePositions);
    deformationSlider.addEventListener('input', updatePositions);
  </script>
</body>
<?php
    include '../../footer_e.php';
?>