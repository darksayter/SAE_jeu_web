<?php 
    session_start();
    include 'header.php';
    include '../controllers/connexion_bdd.php';
    $host = "database"; 
    $dbname = "sae-jeu-web";
    $user = "sae-jeu-web";
    $password = "O289QDLFJ4qN";
    $dsn = "mysql:host=$host;dbname=$dbname;user=$user;password=$password";

    $id_utilisateur = $_SESSION['id_utilisateur']; 
    $con = new PDO($dsn);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $con->prepare("SELECT id_equipe FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->execute();

    // Récupérer le nom de l'équipe
    $id_equipe = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($id_equipe)) {
        $id_equipe = $id_equipe['id_equipe'];
    } else {
        echo "Vous n'êtes pas dans une équipe.";
        echo $_SESSION['id_utilisateur'];
        echo $_SESSION['id_equipe'];
        exit(0);
    }
?>

<head>
<link rel="stylesheet" type="text/css" href="../../assets/CSS/style.css" />
<style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #chat-box {
            width: 100%;
            height: 400px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
        }

        #message-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
        }

        #send-btn {
            display: block;          /* Fait du bouton un bloc, ce qui lui permet de prendre toute la largeur */
            width: 100%;             /* Prend toute la largeur disponible */
            padding: 10px;           /* Ajoute de l'espace à l'intérieur du bouton */
            border: 1px solid #ccc; /* Ajoute une bordure similaire à celle des autres éléments */
            background-color: #4CAF50; /* Vous pouvez choisir la couleur du bouton */
            color: white;            /* Texte en blanc */
            font-size: 16px;         /* Taille de la police */
            cursor: pointer;        /* Change le curseur pour indiquer qu'il est cliquable */
            margin-top: 10px;        /* Ajoute un peu d'espace au-dessus du bouton */
            text-align: center;      /* Centre le texte à l'intérieur du bouton */
        }

        #send-btn:hover {
            background-color: #45a049; /* Change légèrement la couleur quand on survole le bouton */
        }

        .message {
            margin-bottom: 10px;
        }

        .sender {
            font-weight: bold;
        }

        .timestamp {
            font-size: 0.8em;
            color: #888;
        }

    </style>
</head>



<body class="body">
<h1>Chat d'équipe</h1>
    <div id="chat-box"></div>
    <textarea id="message-input" placeholder="Tapez votre message ici..."></textarea>
    <button id="send-btn">Envoyer</button>
    <script >
            const chatBox = document.getElementById("chat-box");
            const messageInput = document.getElementById("message-input");
            const sendBtn = document.getElementById("send-btn");
            const senderId = <?php echo $id_utilisateur; ?>;
            const teamId = <?php echo $id_equipe; ?>;

        // Charger les messages
        function loadMessages() {
            fetch(`get_messages.php?team_id=${teamId}`)
            .then(response => response.text())  // Utilisez .text() pour récupérer du texte brut
            .then(text => {
                console.log("Texte brut reçu :", text);  // Affichez la réponse brute pour voir ce qui est renvoyé
                try {
                    const messages = JSON.parse(text);  // Essayez de parser le JSON
                    chatBox.innerHTML = "";  // Effacer le contenu précédent
                    if (Array.isArray(messages) && messages.length > 0) {
                        messages.forEach(msg => {
                            const messageDiv = document.createElement("div");
                            messageDiv.className = "message";
                            messageDiv.innerHTML = `
                                <span class="sender">${msg.sender}</span>: 
                                <span class="content">${msg.content}</span>
                                <span class="timestamp">(${msg.temps})</span>
                            `;
                            chatBox.appendChild(messageDiv);
                        });
                    } else {
                        console.error("Les messages sont vides ou mal formatés", messages);
                    }
                    chatBox.scrollTop = chatBox.scrollHeight; // Défiler en bas
                } catch (err) {
                    console.error("Erreur de parsing JSON :", err);
                    alert("Une erreur est survenue lors du traitement des données.");
                }
            })
            .catch(error => {
                console.error("Erreur réseau :", error);
                alert("Erreur réseau ou serveur.");
            });

    }   

        // Envoyer un message
        sendBtn.addEventListener("click", () => {
            const message = messageInput.value.trim();
            if (!message) return;

            console.log({ senderId, teamId, message });


            fetch("send_message.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `sender_id=${senderId}&team_id=${teamId}&message=${encodeURIComponent(message)}`
            })
            .then(response => response.text()) // Récupérer le texte brut pour diagnostic
            .then(text => {
                try {
                    const data = JSON.parse(text); // Analyse du JSON
                    if (data.success) {
                        alert("Message envoyé avec succès");
                        messageInput.value = ""; // Vider l'input
                        loadMessages(); // Recharger les messages
                    } else {
                        alert("Erreur : " + (data.error || "Inconnue"));
                    }
                } catch (err) {
                    console.error("Erreur de parsing JSON :", err);
                    alert("Une erreur est survenue lors du traitement des données.");
                }
            })
            .catch(error => {
                console.error("Erreur réseau :", error);
                alert("Erreur réseau ou serveur.");
            });



        });

        // Recharger les messages toutes les 5 secondes
        setInterval(loadMessages, 2000);

        // Charger les messages au démarrage
        loadMessages();

    </script>
</body>

<?php
    include '../Enigmes/footer.php';
?>