<?php
    include '../../header_e.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
<style>
  body {
    font-family: Arial, sans-serif;
    text-align: center;
  }
  
  .container {
    margin-top: 50px;
  }
  
  .puzzle-container {
    display: grid;
    grid-template-columns: repeat(4, 200px);
    grid-gap: 5px;
    justify-content: center;
  }
  
  .puzzle-piece {
    width: 200px;
    height: 100px;
    background-color: #ccc;
    border: 2px solid #333;
    display: inline-block;
    background-size: cover;
    background-position: center;
  }
  
  #enigme-container {
    margin-top: 30px;
  }
  
  input {
    padding: 5px;
    margin-top: 10px;
  }
  
  button {
    margin-top: 10px;
    padding: 5px 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #45a049;
  }
  
  .puzzle-piece {
    width: 200px;
    height: 100px;
    background-color: #ccc;
    border: 2px solid #333;
    display: inline-block;
    background-size: cover;
    background-position: center;
  }
  
  .puzzle-piece.degri {
    background-color: transparent;
    border: 2px solid #4CAF50;
    cursor: pointer;
  }
</style>
<body>
  <div class="container">
    <h1>Découvre le message caché !</h1>
    <div class="puzzle-container">
      <div class="puzzle-piece" data-id="1" draggable="true"></div>
      <div class="puzzle-piece" data-id="2" draggable="true"></div>
      <div class="puzzle-piece" data-id="3" draggable="true"></div>
      <div class="puzzle-piece" data-id="4" draggable="true"></div>
    <div class="puzzle-piece" data-id="5" draggable="true"></div>
    <div class="puzzle-piece" data-id="6" draggable="true"></div>
    <div class="puzzle-piece" data-id="7" draggable="true"></div>
    <div class="puzzle-piece" data-id="8" draggable="true"></div>
    <div class="puzzle-piece" data-id="9" draggable="true"></div>
    <div class="puzzle-piece" data-id="10" draggable="true"></div>
    <div class="puzzle-piece" data-id="11" draggable="true"></div>
    <div class="puzzle-piece" data-id="12" draggable="true"></div>
    <div class="puzzle-piece" data-id="13" draggable="true"></div>
    <div class="puzzle-piece" data-id="14" draggable="true"></div>
    <div class="puzzle-piece" data-id="15" draggable="true"></div>
    <div class="puzzle-piece" data-id="16" draggable="true"></div>
      
    </div>

    <div id="enigme-container">
      <h3>Enigme pour débloquer la pièce</h3>
      <div id="enigme"></div>
      <input type="text" id="reponse" placeholder="Réponse...">
      <button id="verifier">Vérifier</button>
    </div>
  </div>

  <script src="script.js"></script>
</body>
<?php
    include '../../footer_e.php';
?>