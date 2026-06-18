<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <div class="container">
        <h2>Liste des utilisateurs</h2>
        <table class="data-table">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Login</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id_utilisateur']) ?></td>
                    <td><?= htmlspecialchars($user['nom']) ?></td>
                    <td><?= htmlspecialchars($user['prenom']) ?></td>
                    <td><?= htmlspecialchars($user['login']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="index.php?controller=admin&action=edit&id=<?= $user['id_utilisateur'] ?>">Modifier</a>
                        <a href="index.php?controller=admin&action=delete&id=<?= $user['id_utilisateur'] ?>"
                            onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ? Cette action est irréversible.')">Supprimer</a>
                        <a href="index.php?controller=admin&action=revoquerSession&session_id=<?= urlencode($sessionsActives[$user['id_utilisateur']] ?? '') ?>"
                           onclick="return confirm('Forcer la déconnexion de cet utilisateur ?')">Déconnecter</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>