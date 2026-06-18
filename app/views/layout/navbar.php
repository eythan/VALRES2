<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Navbar</title>
    <link rel="stylesheet" href="/css/navbar.css">
</head>

<body>
    <nav>
        <div class="dropdown">
            <a href="index.php?controller=reservation&action=index">Reservation</a>
            <div class="dropdown-content">
                <?php if (in_array($_SESSION['user_role'], ['Responsable', 'Secretariat', 'Administrateur'])): ?>
                    <a href="index.php?controller=reservation&action=add">Ajouter</a>
                <?php endif; ?>
                
                <a href="index.php?controller=reservation&action=index">Lister</a>
            </div>
        </div>

        <?php if ($_SESSION['user_role'] === 'Administrateur'): ?>
            <div class="dropdown">
                <a href="index.php?controller=admin&action=index">Administrateur</a>
                <div class="dropdown-content">
                    <a href="index.php?controller=admin&action=add">Ajouter</a>
                    <a href="index.php?controller=admin&action=index">Lister</a>
                    <a href="index.php?controller=admin&action=exportXml">Exporter (XML)</a>
                    <a href="index.php?controller=admin&action=journal">Journal</a>
                </div>
            </div>
        <?php endif; ?>

        <a href="index.php?controller=auth&action=logout">Déconnexion</a>
    </nav>
</body>

</html>