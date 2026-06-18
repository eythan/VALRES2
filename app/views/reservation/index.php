<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des réservations</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layout/navbar.php'; ?>
    
    <div class="container">
        <h2>Liste des réservations</h2>
        <table class="data-table">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Période</th>
                <th>État</th>
                <th>Salle</th>
                <th>Utilisateur</th>
                <?php if ($_SESSION['user_role'] !== 'Utilisateur'): ?>
                    <th>Actions</th> 
                <?php endif; ?>
            </tr>
            
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?= htmlspecialchars($reservation['id_reservation']) ?></td>
                    <td><?= htmlspecialchars($reservation['date_']) ?></td>
                    <td><?= htmlspecialchars($reservation['periode']) ?></td>
                    <td><?= htmlspecialchars($reservation['etat']) ?></td>
                    <td><?= htmlspecialchars($reservation['id_salle']) ?></td>
                    <td><?= htmlspecialchars($reservation['id_utilisateur']) ?></td>
                    
                    <?php if ($_SESSION['user_role'] !== 'Utilisateur'): ?>
                        <td>
                            <?php if (in_array($_SESSION['user_role'], ['Secretariat', 'Administrateur'])): ?>
                                <a href="index.php?controller=reservation&action=edit&id=<?= $reservation['id_reservation'] ?>">Modifier</a>
                            <?php endif; ?>

                            <?php if (in_array($_SESSION['user_role'], ['Responsable', 'Secretariat', 'Administrateur'])): ?>
                                <a href="index.php?controller=reservation&action=delete&id=<?= $reservation['id_reservation'] ?>"
                                   onclick="return confirm('Supprimer ?')">Supprimer</a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>