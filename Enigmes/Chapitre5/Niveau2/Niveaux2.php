<?php
    include '../../header_e.php';
?>
<head>
	<link rel="stylesheet" type="text/css" href="../../../assets/CSS/style.css" />
    <style>
    .boudy {
    font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            }
        h1 {
            margin: 20px;
            color: #333;
        }
        iframe {
            border: none;
            width: 80%;
            height: 80vh;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .fallback {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
	<div class = "boudy">
    <?php
    // Chemin du PDF à afficher
    $pdfPath = "admission_randmi.pdf";

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
</div>
</body>
<?php
    include '../../footer_e.php';
?>