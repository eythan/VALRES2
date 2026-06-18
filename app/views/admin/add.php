<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Utilisateur</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php include __DIR__ . '/../layout/navbar.php'; ?>

    <div class="container">
        <h2>Ajouter un nouvel utilisateur</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" class="form-container">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" placeholder="Nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>

            <label for="login">Login :</label>
            <input type="text" id="login" name="login" placeholder="Adresse email" required>

            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required>

            <label for="role">Rôle :</label>
            <select name="role" id="role">
                <option value="Utilisateur">Utilisateur</option>
                <option value="Administrateur">Administrateur</option>
                <option value="Secretariat">Secrétariat</option>
                <option value="Responsable">Responsable</option>
            </select>

            <label for="id_structure">ID Structure :</label>
            <input type="number" id="id_structure" name="id_structure" placeholder="ID Structure">

            <button type="submit" class="form-btn-submit">Créer l'utilisateur</button>
        </form>
    </div>
</body>

</html>