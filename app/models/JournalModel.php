<?php
function logActivite($pdo, $idUtilisateur, $action, $detail, $ip)
{
    $stmt = $pdo->prepare("
        INSERT INTO journal_activites (id_utilisateur, action, detail, date_heure, ip_adresse)
        VALUES (?, ?, ?, NOW(), ?)
    ");
    $stmt->execute([$idUtilisateur, $action, $detail, $ip]);
}

function getJournal($pdo)
{
    $stmt = $pdo->prepare("
        SELECT j.id, j.action, j.detail, j.date_heure, j.ip_adresse, u.nom, u.prenom
        FROM journal_activites j
        LEFT JOIN utilisateurs u ON j.id_utilisateur = u.id_utilisateur
        ORDER BY j.date_heure DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function rechercherJournal($pdo, $action, $jour)
{
    $stmt = $pdo->prepare("
        SELECT j.id, j.action, j.detail, j.date_heure, j.ip_adresse, u.nom, u.prenom
        FROM journal_activites j
        LEFT JOIN utilisateurs u ON j.id_utilisateur = u.id_utilisateur
        WHERE (? = '' OR j.action = ?)
          AND (? = '' OR DATE(j.date_heure) = ?)
        ORDER BY j.date_heure DESC
    ");
    $stmt->execute([$action, $action, $jour, $jour]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
