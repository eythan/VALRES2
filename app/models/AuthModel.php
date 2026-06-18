<?php
function getUserByLogin($pdo, $login)
{
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $stmt->execute([$login]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}