<?php
function getAllReservations($pdo)
{
    $stmt = $pdo->query("SELECT * FROM reservation");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addReservation($pdo, $roomId, $userId, $date, $period, $status = 'Provisional')
{
    $stmt = $pdo->prepare("SELECT id_salle FROM salles WHERE id_salle = ?");
    $stmt->execute([$roomId]);
    if ($stmt->rowCount() === 0) {
        return false;
    }

    $stmt = $pdo->query("SELECT MAX(CAST(id_reservation AS UNSIGNED)) AS max_id FROM reservation");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nextId = ($row && $row['max_id']) ? intval($row['max_id']) + 1 : 1;

    $stmt = $pdo->prepare("
        INSERT INTO reservation (id_reservation, date_, periode, etat, id_salle, id_utilisateur)
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([$nextId, $date, $period, $status, $roomId, $userId]);

    return $nextId;
}

function getReservationById($pdo, $reservationId)
{
    $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_reservation = ?");
    $stmt->execute([$reservationId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateReservation($pdo, $reservationId, $date, $period, $status, $roomId)
{
    $stmt = $pdo->prepare("
        UPDATE reservation 
        SET date_ = ?, periode = ?, etat = ?, id_salle = ? 
        WHERE id_reservation = ?
    ");
    return $stmt->execute([$date, $period, $status, $roomId, $reservationId]);
}

function deleteReservation($pdo, $reservationId)
{
    $stmt = $pdo->prepare("DELETE FROM reservation WHERE id_reservation = ?");
    return $stmt->execute([$reservationId]);
}
