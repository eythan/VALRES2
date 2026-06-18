<?php
session_start();

require '../config/database.php';

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

$basePath = '../app/controllers/';

if ($controller == 'auth') {
    require $basePath . 'AuthController.php';

} elseif ($controller == 'admin') {
    require $basePath . 'AdminController.php';

} elseif ($controller == 'reservation') {
    require $basePath . 'ReservationController.php';
} else {
    http_response_code(404);
    echo "Controller non trouvé : " . htmlspecialchars($controller);
}
