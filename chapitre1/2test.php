<style>
.indice-cards {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .indice-card {
            width: 80px;
            height: 120px;
            background: rgba(0, 0, 0, 0.9);
            color: #00ff00;
            border: 2px solid #00ff00;
            border-radius: 10px;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 0 10px #00ff00;
        }

        .indice-card:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px #00ff00, 0 0 30px #00ff00 inset;
        }
        .notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: #00ff00;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 15px #00ff00;
            display: none; /* Cache le message par défaut */
            z-index: 9999;
            width: 300px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
</style>

<?php
function isIndiceAlreadyUsed($userId, $indice, $levelId) {
    global $dsn;
    try {
        $con = new PDO($dsn);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérification de l'existence de l'indice pour cet utilisateur et ce niveau
        $stmt = $con->prepare('SELECT COUNT(*) FROM Indice WHERE id_utilisateur = :userId AND num_indice = :indice AND id_niveau = :levelId');
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':indice', $indice);
        $stmt->bindParam(':levelId', $levelId);
        $stmt->execute();

        $result = $stmt->fetchColumn();

        return $result > 0; // Si le résultat est supérieur à 0, cela signifie que l'indice est déjà utilisé
    } catch (PDOException $e) {
        echo 'Erreur de vérification : ' . $e->getMessage();
        return false;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['indice'])) {
    $indice = $_POST['indice']; // Récupère l'indice
    $levelId = 1; // Niveau actuel (ici, supposé être niveau 1)

    // Vérification de l'indice avant insertion
    if (!isIndiceAlreadyUsed($id_user, $indice, $levelId)) {
        try {
            $con = new PDO($dsn);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Insertion de l'indice dans la base de données
            $stmt = $con->prepare('INSERT INTO Indice (id_utilisateur, id_niveau, num_indice) VALUES (:id_user, :levelId, :indice)');
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':levelId', $levelId);
            $stmt->bindParam(':indice', $indice);
            $stmt->execute();

            $message = "Indice $indice ajouté avec succès à la base de données!";
        } catch (PDOException $e) {
            $message = "Erreur lors de l'insertion des données : " . $e->getMessage();
        }
    } else {
        $message = "L'indice $indice a déjà été utilisé dans ce niveau.";
    }
}
?>

<div class="indice-cards">
            <div class="indice-card" onclick="submitIndice(1)">
                <h2>Indice 1</h2>
            </div>
            <div class="indice-card" onclick="submitIndice(2)">
                <h2>Indice 2</h2>
            </div>
        </div>
        <div id="notification" class="notification">
            <p id="notification-message"></p>
        </div>

        
<script>
    if (typeof success !== "undefined") {
        if (success) {
            alert("Bravo ! Vous avez réussi à vous connecter au test, le plus dur commence maintenant !");
            window.location.href = "../Niveau2/Niveaux2.php";
        } else {
            alert("Identifiant ou mot de passe incorrect. Essayez encore !");
        }
    }

    
    function submitIndice(indice) {
        var formData = new FormData();
        formData.append("indice", indice);

        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            var notification = document.getElementById('notification');
            var message = document.getElementById('notification-message');

            // Affiche un message personnalisé pour chaque indice
            if (indice === 1) {
                message.innerHTML = "Voici l'indice 1";
            } else if (indice === 2) {
                message.innerHTML = "Voici l'indice 2";
            }

            notification.style.display = 'block';
            notification.style.opacity = '1';

            // Masquer le message après 3 secondes
            setTimeout(function() {
                notification.style.opacity = '0';
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 500); // Masquer complètement après la transition
            }, 3000); // Après 3 secondes
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    }
</script>