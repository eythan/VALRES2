<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <div class="container">
        <h2>Modifier un utilisateur</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" class="form-container">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>

            <label for="login">Login :</label>
            <input type="text" name="login" value="<?= htmlspecialchars($user['login']) ?>" required>

            <label for="role">Rôle :</label>
            <select name="role" required>
                <option value="Administrateur" <?= $user['role'] === 'Administrateur' ? 'selected' : '' ?>>Administrateur
                </option>
                <option value="Secretariat" <?= $user['role'] === 'Secretariat' ? 'selected' : '' ?>>Secrétariat</option>
                <option value="Responsable" <?= $user['role'] === 'Responsable' ? 'selected' : '' ?>>Responsable</option>
                <option value="Utilisateur" <?= $user['role'] === 'Utilisateur' ? 'selected' : '' ?>>Utilisateur</option>
            </select>

            <label for="id_structure">ID Structure :</label>
            <input type="number" name="id_structure" value="<?= htmlspecialchars($user['id_structure']) ?>" required>
            <button type="submit" class="form-btn-submit">Enregistrer</button>
        </form>
    </div>
</body>

</html>