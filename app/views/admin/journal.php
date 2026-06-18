<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Journal des activités</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <div class="container">
        <h2>Journal des activités</h2>

        <form method="GET" action="index.php">
            <input type="hidden" name="controller" value="admin">
            <input type="hidden" name="action" value="journal">

            <select name="action_filtre">
                <option value="">-- Toutes les actions --</option>
                <option value="Connexion" <?= ($action_filtre === 'Connexion') ? 'selected' : '' ?>>Connexion</option>
                <option value="Déconnexion" <?= ($action_filtre === 'Déconnexion') ? 'selected' : '' ?>>Déconnexion</option>
                <option value="Ajout réservation" <?= ($action_filtre === 'Ajout réservation') ? 'selected' : '' ?>>Ajout réservation</option>
                <option value="Suppression réservation" <?= ($action_filtre === 'Suppression réservation') ? 'selected' : '' ?>>Suppression réservation</option>
                <option value="Création utilisateur" <?= ($action_filtre === 'Création utilisateur') ? 'selected' : '' ?>>Création utilisateur</option>
            </select>

            <input type="date" name="jour" value="<?= htmlspecialchars($jour) ?>">

            <button type="submit">Filtrer</button>
            <a href="index.php?controller=admin&action=journal">Réinitialiser</a>
        </form>

        <table class="data-table">
            <tr>
                <th>Date / Heure</th>
                <th>Utilisateur</th>
                <th>Action</th>
                <th>Détail</th>
                <th>Adresse IP</th>
            </tr>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= htmlspecialchars($log['date_heure']) ?></td>
                    <td><?= htmlspecialchars($log['prenom'] . ' ' . $log['nom']) ?></td>
                    <td><?= htmlspecialchars($log['action']) ?></td>
                    <td><?= htmlspecialchars($log['detail']) ?></td>
                    <td><?= htmlspecialchars($log['ip_adresse']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>
