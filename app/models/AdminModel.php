<?php
function getAllUsers($pdo)
{
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addUser($pdo, $lastName, $firstName, $login, $password, $role, $structureId)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
        INSERT INTO utilisateurs (nom, prenom, login, mot_de_passe, role, id_structure)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    return $stmt->execute([
        $lastName,
        $firstName,
        $login,
        $hashedPassword,
        $role,
        $structureId
    ]);
}

function getUserById($pdo, $userId)
{
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUser($pdo, $userId, $lastName, $firstName, $login, $role, $structureId)
{
    $stmt = $pdo->prepare("
        UPDATE utilisateurs
        SET nom = ?, prenom = ?, login = ?, role = ?, id_structure = ?
        WHERE id_utilisateur = ?
    ");
    return $stmt->execute([$lastName, $firstName, $login, $role, $structureId, $userId]);
}

function deleteUser($pdo, $userId)
{
    $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id_utilisateur = ?");
    return $stmt->execute([$userId]);
}

function getUsersForExport($pdo) {
    $sql = "SELECT nom, prenom, login, role FROM utilisateurs";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}