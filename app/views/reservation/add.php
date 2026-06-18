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
        <h2>Ajouter une réservation</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" class="form-container"> 
            
            <label for="id_salle">ID Salle :</label>
            <input type="text" id="id_salle" name="id_salle" required
                placeholder="ID d'une salle existante">

            <label for="date_">Date :</label>
            <input type="date" id="date_" name="date_" required>

            <label for="periode">Période :</label>
            <input type="text" id="periode" name="periode" required>

            <button type="submit" name="ajouter" class="form-btn-submit">Ajouter</button>
        </form>
    </div>
</body>

</html>