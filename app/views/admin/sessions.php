<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Sessions actives</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <div class="container">
        <h2>Sessions actives</h2>

        <table class="data-table">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($sessions as $session): ?>
                <tr>
                    <td><?= htmlspecialchars($session['nom']) ?></td>
                    <td><?= htmlspecialchars($session['prenom']) ?></td>
                    <td><?= htmlspecialchars($session['role']) ?></td>
                    <td>
                        <a href="index.php?controller=admin&action=revoquerSession&session_id=<?= urlencode($session['session_id']) ?>"
                           onclick="return confirm('Forcer la déconnexion de cet utilisateur ?')">Déconnecter</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>