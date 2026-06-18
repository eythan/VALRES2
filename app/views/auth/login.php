<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <h2>Connexion</h2>

        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="index.php?controller=auth&action=login" class="form-container">

            <label for="login">Email :</label>
            <input type="text" id="login" name="login" placeholder="Votre identifiant" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

            <button type="submit" class="form-btn-submit">Connexion</button>
        </form>
    </div>
</body>

</html>