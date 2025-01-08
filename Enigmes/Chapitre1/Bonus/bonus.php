<?php
    include '../../header_e.php';
    include '../../../controllers/connexion_bdd.php';
    session_start();
?>
<head>
    <link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
    <style>
        .bodiv {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        h1 {           
            text-align: center;
            font-size : 50px; 
        }

        iframe {
            border: none;
            width: 80%;
            height: 80vh;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .fallback {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            width: 80%;
        }

        pre {
            text-align: left;
        }

        .submit-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            text-align : center;
            background: linear-gradient(45deg, #40819F, #335571);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
            transition: background-color 0.3s, transform 0.2s;
            width : 300px; 
            
        }

        .submit-btn:hover {
            background: linear-gradient(45deg, #333954, #1b2d45);
            transform: scale(1.1);
        }
    </style>
</head>
<body class="body">
    <h1>Félicitation pour votre admission !</h1>
    
    <div class="bodiv">
        <?php
        $pdfPath = "admission.pdf";

        // Vérifier si le fichier existe
        if (file_exists($pdfPath)) {
            echo '<iframe src="' . htmlspecialchars($pdfPath) . '"></iframe>';
        } else {
            // Afficher un fallback en Markdown si le PDF est introuvable
            echo '<div class="fallback">';
            echo '<h2>Erreur</h2>';
            echo '<p>Le fichier PDF n\'a pas pu être chargé. Voici l\'énigme en Markdown :</p>';
            echo '<pre>';
            echo "## Énigme\n";
            echo "1. **Question 1** : Quelle est la somme de 2 et 2 ?\n";
            echo "2. **Question 2** : Devinez un mot de 5 lettres...\n";
            echo "Bonne chance !";
            echo '</pre>';
            echo '</div>';
        }
        ?>
       
        <a href="../../../../chapitres.php" class="submit-btn">Retour à la liste des chapitres</a>
    </div>
</body>

<?php
    include '../../footer_e.php';
?>
