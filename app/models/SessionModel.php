<?php
function creerSession($pdo, $sessionId, $idUtilisateur)
{
    $stmt = $pdo->prepare("
        INSERT INTO sessions_actives (session_id, id_utilisateur)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE id_utilisateur = VALUES(id_utilisateur)
    ");
    $stmt->execute([$sessionId, $idUtilisateur]);
}

function supprimerSession($pdo, $sessionId)
{
    $stmt = $pdo->prepare("DELETE FROM sessions_actives WHERE session_id = ?");
    $stmt->execute([$sessionId]);
}

function getSessions($pdo)
{
    $stmt = $pdo->prepare("
        SELECT s.session_id, s.id_utilisateur
        FROM sessions_actives s
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
}