const chatBox = document.getElementById("chat-box");
const messageInput = document.getElementById("message-input");
const sendBtn = document.getElementById("send-btn");

// Charger les messages
function loadMessages() {
    alert("Chargement des messages");
    fetch(`get_messages.php?team_id=${teamId}`)
        .then(response => response.json())
        .then(messages => {
            chatBox.innerHTML = ""; // Effacer le contenu précédent
            messages.forEach(msg => {
                const messageDiv = document.createElement("div");
                messageDiv.className = "message";
                messageDiv.innerHTML = `
                    <span class="sender">${msg.sender_name}</span>: 
                    <span class="content">${msg.message}</span>
                    <span class="timestamp">(${msg.timestamp})</span>
                `;
                chatBox.appendChild(messageDiv);
            });
            chatBox.scrollTop = chatBox.scrollHeight; // Défiler en bas
        });
}

// Envoyer un message
sendBtn.addEventListener("click", () => {
    alert("Envoi du message");
    const message = messageInput.value.trim();
    if (!message) return;

    fetch("send_message.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `sender_id=${senderId}&team_id=${teamId}&message=${encodeURIComponent(message)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Message envoyé avec succès");
            messageInput.value = ""; // Vider l'input
            loadMessages(); // Recharger les messages
        }
        else {
            alert("Erreur lors de l'envoi du message");
        }
    });
});

// Recharger les messages toutes les 5 secondes
setInterval(loadMessages, 2000);

// Charger les messages au démarrage
loadMessages();
