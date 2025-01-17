<?php
    include '../../header_e.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <style>
  
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      text-align: center;
      background-color: #000;
      color: #fff;
    }
    h1 {
      margin: 20px;
    }
    #map {
      width: 100%;
      height: 500px;
    }
    .instructions {
      margin: 20px;
      font-size: 18px;
    }
    #result {
      margin: 20px;
      font-size: 20px;
      font-weight: bold;
    }
    /* Style pour la boussole avec N, S, E, W */
    .compass-container {
      position: absolute;
      bottom: 10px;
      left: 10px;
      width: 60px;
      height: 60px;
      background-color: rgba(255, 255, 255, 0.7);
      border-radius: 50%;
      text-align: center;
      font-size: 16px;
      color: #000;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }
    .compass-container span {
      position: absolute;
      font-weight: bold;
    }
    .compass-container .north {
      top: 5px;  /* Positionné au-dessus */
      left: 50%;
      transform: translateX(-50%);
    }
    .compass-container .south {
      bottom: 5px;  /* Positionné en bas */
      left: 50%;
      transform: translateX(-50%);
    }
    .compass-container .east {
      top: 50%;
      right: 5px;  /* Positionné à droite */
      transform: translateY(-50%);
    }
    .compass-container .west {
      top: 50%;
      left: 5px;  /* Positionné à gauche */
      transform: translateY(-50%);
    }
  </style>
</head>
<body>
  <h1>Énigme Finale : Trouvez l'Endroit</h1>
  <div class="instructions">"Ancienne place de réunion, là où le pouvoir et les disputes se croisaient,
    Je suis un lieu où l'Histoire se souvient de ma beauté comme de ma cruauté.
    Au centre de toutes routes, traverse la route de l'est et tu me trouveras au carrefour des révélations."</div>
  <div id="map"></div>
  <div id="result"></div>

  <!-- Boussole avec N, S, E, W -->
  <div class="compass-container">
    <span class="north">N</span>
    <span class="south">S</span>
    <span class="east">E</span>
    <span class="west">W</span>
  </div>

  <script>
    // Coordonnées cibles (colisé)
    const targetLat =  41.8902; // Latitude de la colisé
    const targetLng = 12.4945; // Longitude de la colisé
    const tolerance = 0.001; // Tolérance (en degrés, environ 500 mètres)

    // Carte Leaflet
    //const map = L.map('map').setView([46.603354, 1.888334], 6); // Vue initiale centrée sur Rome
    const map = L.map('map').setView([46.603354, 1.888334], 6); // Vue initiale centrée sur Rome

    // Chargement des tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Gestion du clic sur la carte
    map.on('click', function(e) {
      const { lat, lng } = e.latlng;

      // Vérification de la distance avec la cible
      const distance = Math.sqrt(Math.pow(lat - targetLat, 2) + Math.pow(lng - targetLng, 2));

      const result = document.getElementById('result');
      if (distance <= tolerance) {
        result.textContent = "Bravo ! Vous avez trouvé la bonne position.";
        result.style.color = "lime";
        L.circle([targetLat, targetLng], { radius: 500, color: 'green' }).addTo(map); // Indicateur de zone
      } else {
        result.textContent = "Non, essayez encore !";
        result.style.color = "red";
        L.marker([lat, lng], { color: 'red' }).addTo(map); // Marqueur de tentative
      }
    });
  </script>
</body>
<?php
    include '../../footer_e.php';
?>

