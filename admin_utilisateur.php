<?php
session_start();

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['id_utilisateur']) || $_SESSION['admin'] == 1) {
    header('Location: login.php');
    exit(0);
}

include 'header.php';
include 'controllers/connexion_bdd.php';

try {
    $con = new PDO($dsn);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer la requête pour récupérer les informations des utilisateurs
    $stmt = $con->prepare("SELECT id_utilisateur, nom_utilisateur, mail, admin FROM Utilisateur");
    
    // Exécuter la requête
    $stmt->execute();

    // Récupérer les informations des utilisateurs
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit(0);
}
?>

    <title>Gestion des Utilisateurs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function openModal(id, nom, mail, admin) {
            $('#modal-id').val(id);
            $('#modal-nom').val(nom);
            $('#modal-mail').val(mail);
            if (admin == 1) {
                $('#modal-admin-oui').prop('checked', true);
            } else {
                $('#modal-admin-non').prop('checked', true);
            }
            $('#editModal').show();
        }

        function closeModal() {
            $('#editModal').hide();
        }

        $(document).ready(function() {
            $('#editForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: 'edit_user.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        alert('Utilisateur mis à jour avec succès.');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Erreur lors de la mise à jour de l\'utilisateur.');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="content">
        <h1 class="main-title">Gestion des Utilisateurs</h1>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id_utilisateur']); ?></td>
                    <td><?php echo htmlspecialchars($user['nom_utilisateur']); ?></td>
                    <td><?php echo htmlspecialchars($user['mail']); ?></td>
                    <td><?php echo $user['admin'] ? 'Oui' : 'Non'; ?></td>
                    <td>
                        <a href="javascript:void(0);" onclick="openModal('<?php echo $user['id_utilisateur']; ?>', '<?php echo htmlspecialchars($user['nom_utilisateur']); ?>', '<?php echo htmlspecialchars($user['mail']); ?>', '<?php echo $user['admin']; ?>')">Modifier</a>
                        <a href="delete_user.php?id=<?php echo $user['id_utilisateur']; ?>" class="btn btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="editModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Modifier Utilisateur</h2>
            <form id="editForm">
                <input type="hidden" id="modal-id" name="id_utilisateur">
                <label for="modal-nom">Nom d'utilisateur:</label>
                <input type="text" id="modal-nom" name="nom_utilisateur" required><br><br>
                <label for="modal-mail">Email:</label>
                <input type="email" id="modal-mail" name="mail" required><br><br>
                <label for="modal-admin">Admin:</label><br>
                <input type="radio" id="modal-admin-oui" name="admin" value="1"> Oui
                <input type="radio" id="modal-admin-non" name="admin" value="0"> Non<br><br>
                <button type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
include 'footer.php';
?>