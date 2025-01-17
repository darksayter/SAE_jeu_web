<?php
    include '../../header_e.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
<style>

    .container {
        margin: 100px auto;
        max-width: 1000px;
        width: 90%;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .container .black {
        color : black !important;
    }

    .container .white {
        color : white !important;
        font-size: 5px;
    }

    .hint-image {
        width: 100%;
        max-width: 700px;
        margin: 10px auto;
        border-radius: 8px;
    }

    h1 {
        font-size: 24px;
        color: #1f2846;
        margin-bottom: 15px;
    }

    p {
        font-size: 16px;
    }

    label {
        font-size: 16px;
        color: #333; /* Couleur plus sombre pour une meilleure lisibilité */
    }

    input[type="password"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    #message {
        margin-top: 20px;
        font-size: 16px;
        color: #333;
    }
</style>
</head>
<body>
    
    <div class="container">
        <h1>Connexion</h1>
        <p class = "black">Trouvez le mot de passe caché dans l'image ci-dessous pour déverrouiller l'accès.</p>
        <div class="white">
            <p>RUlFTlNJQ09BVU5PU0VUR1BKVVNURFNBSVlTSUtJ</p>
            <p>YmUgZmFpcg==</p>
            <p>Q0VJTlNUUEFVT0RGTEJHSEpLTVFSVlhZWg==</p>
        </div>

        <img src="imagepc.png" alt="Indice" class="hint-image">
        <form id="login-form">
            <label for="password">Entrez le mot de passe :</label>
            <input type="password" id="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <p id="message"></p>
    </div>
    <script src="script.js">
</script>
</body>
<?php
    include '../../footer_e.php';
?>
