<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier une réservation</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <div class="container">
        <h2>Modifier la réservation n° <?= htmlspecialchars($reservation['id_reservation']) ?></h2>

        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" class="form-container">
            <label for="date_">Date :</label>
            <input type="date" name="date_" value="<?= htmlspecialchars($reservation['date_']) ?>" required>

            <label for="periode">Période :</label>
            <select name="periode" required>
                <option value="Matin" <?= $reservation['periode'] === 'Matin' ? 'selected' : '' ?>>Matin</option>
                <option value="Après-midi" <?= $reservation['periode'] === 'Après-midi' ? 'selected' : '' ?>>Après-midi
                </option>
                <option value="Soirée" <?= $reservation['periode'] === 'Soirée' ? 'selected' : '' ?>>Soirée</option>
            </select>

            <label for="etat">État :</label>
            <select name="etat" required>
                <option value="Provisional" <?= $reservation['etat'] === 'Provisional' ? 'selected' : '' ?>>Provisoire
                </option>
                <option value="Confirmed" <?= $reservation['etat'] === 'Confirmed' ? 'selected' : '' ?>>Confirmée</option>
                <option value="Cancelled" <?= $reservation['etat'] === 'Cancelled' ? 'selected' : '' ?>>Annulée</option>
            </select>

            <label for="id_salle">ID Salle :</label>
            <input type="number" name="id_salle" value="<?= htmlspecialchars($reservation['id_salle']) ?>" required>

            <button type="submit" class="form-btn-submit">Enregistrer les modifications</button>
        </form>
    </div>
</body>

</html>