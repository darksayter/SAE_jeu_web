<?php
include 'header.php';
?>

<!-- BODY -->
 <body class="body">
        <br>
        <div class="content">
            <!-- TITRE -->    
            <div class="container">
                <span id="text"></span><span class="cursor">_</span>
            </div>
            <script src="assets/JAVASCRIPT/ecriture_admin.js"></script>
    
            <br>
            <!-- Description -->
            <p class="description">
                abcdefghijklmnopqrstuvwxyz, abcdefghijklmnopqrstuvwxyz.
            </p>
            <br>
            <br>
            <!-- Boutons -->
            <div class="button-container">
                <div class="row">
                    <a href="admin_utilisateur.php" class="custom-button">Utilisateurs</a>
                    <a href="admin_equipe.php" class="custom-button">Équipes</a>
                    <a href="admin_niveau.php" class="custom-button">Niveaux</a>
                </div>
            </div>
        </div>
        <br>
        <br>
<?php
include 'footer.php';
?>