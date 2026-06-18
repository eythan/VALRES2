<?php
function checkRole($allowedRoles)
{
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
        header("Location: index.php?controller=auth&action=login");
        exit;
    }

    if (!in_array($_SESSION['user_role'], $allowedRoles)) {
        echo "Accès refusé";
        exit;
    }
}
