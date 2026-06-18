<?php
require __DIR__ . '/../models/ReservationModel.php';
require __DIR__ . '/../utils/CheckAuth.php';

checkRole(['Utilisateur', 'Responsable', 'Secretariat', 'Administrateur']);

$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    $reservations = getAllReservations($pdo);
    require __DIR__ . '/../views/reservation/index.php';
}

if ($action === 'add') {
    checkRole(['Responsable', 'Secretariat', 'Administrateur']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userId = $_SESSION['user_id'] ?? null;
        $roomId = $_POST['id_salle'] ?? null;
        $date = $_POST['date_'] ?? null;
        $period = $_POST['periode'] ?? null;

        if ($roomId && $date && $period) {
            $reservationId = addReservation($pdo, $roomId, $userId, $date, $period);

            $message = $reservationId
                ? "Reservation added with ID: $reservationId"
                : "Error adding reservation.";
        } else {
            $message = "All fields are required.";
        }
    }

    $reservations = getAllReservations($pdo);
    require __DIR__ . '/../views/reservation/add.php';
}

if ($action === 'edit') {
    checkRole(['Secretariat', 'Administrateur']);
    $reservationId = $_GET['id'] ?? null;

    if ($reservationId) {
        $reservation = getReservationById($pdo, $reservationId);

        if (!$reservation) {
            header("Location: index.php?controller=reservation&action=index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            updateReservation(
                $pdo,
                $reservationId,
                $_POST['date_'],
                $_POST['periode'],
                $_POST['etat'],
                $_POST['id_salle']
            );
            header("Location: index.php?controller=reservation&action=index");
            exit;
        }

        require __DIR__ . '/../views/reservation/edit.php';
    } else {
        header("Location: index.php?controller=reservation&action=index");
        exit;
    }
}
if ($action === 'delete') {
    checkRole(['Responsable', 'Secretariat', 'Administrateur']);
    $reservationId = $_GET['id'] ?? null;
    if ($reservationId) {
        deleteReservation($pdo, $reservationId);
    }
    header("Location: index.php?controller=reservation&action=index");
    exit;
}
