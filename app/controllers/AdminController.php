<?php
require __DIR__ . '/../models/AdminModel.php';
require __DIR__ . '/../models/JournalModel.php';
require __DIR__ . '/../models/SessionModel.php';
require __DIR__ . '/../utils/CheckAuth.php';
checkRole(['Administrateur']);

$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    $users = getAllUsers($pdo);
    $sessionsActives = getSessions($pdo);
    require __DIR__ . '/../views/admin/index.php';
}

if ($action === 'add') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'] ?? null;
        $prenom = $_POST['prenom'] ?? null;
        $login = $_POST['login'] ?? null;
        $password = $_POST['mdp'] ?? null;
        $role = $_POST['role'] ?? 'Utilisateur';
        $structureId = $_POST['id_structure'] ?? null;

        if ($nom && $prenom && $login && $password) {
            $success = addUser($pdo, $nom, $prenom, $login, $password, $role, $structureId);
            
            if ($success) {
                header("Location: index.php?controller=admin&action=index");
                exit;
            } else {
                $error = "Erreur lors de l'ajout de l'utilisateur.";
            }
        } else {
            $error = "Tous les champs obligatoires doivent être remplis.";
        }
    }
    require __DIR__ . '/../views/admin/add.php';
}

if ($action === 'edit') {
    $userId = $_GET['id'] ?? null;
    if ($userId) {
        $user = getUserById($pdo, $userId);
        if (!$user) {
            header("Location: index.php?controller=admin&action=index");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            updateUser(
                $pdo,
                $userId,
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['login'],
                $_POST['role'],
                $_POST['id_structure']
            );
            header("Location: index.php?controller=admin&action=index");
            exit;
        }
        require __DIR__ . '/../views/admin/edit.php';
    } else {
        header("Location: index.php?controller=admin&action=index");
        exit;
    }
}

if ($action === 'delete') {
    $userId = $_GET['id'] ?? null;
    if ($userId) {
        deleteUser($pdo, $userId);
    }
    header("Location: index.php?controller=admin&action=index");
    exit;
}

if ($action === 'revoquerSession') {
    $sessionId = $_GET['session_id'] ?? '';
    if ($sessionId) {
        supprimerSession($pdo, $sessionId);
    }
    header("Location: index.php?controller=admin&action=index");
    exit;
}

if ($action === 'journal') {
    $action_filtre = $_GET['action_filtre'] ?? '';
    $jour = $_GET['jour'] ?? '';
    $logs = rechercherJournal($pdo, $action_filtre, $jour);
    require __DIR__ . '/../views/admin/journal.php';
}

if ($action === 'exportXml') {
    $users = getUsersForExport($pdo);
    
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><utilisateurs/>');
    
    foreach ($users as $user) {
        $item = $xml->addChild('utilisateur');
        $item->addChild('nom', htmlspecialchars($user['nom']));
        $item->addChild('prenom', htmlspecialchars($user['prenom']));
        $item->addChild('login', htmlspecialchars($user['login']));
        $item->addChild('role', htmlspecialchars($user['role']));
    }

    header('Content-Type: application/xml; charset=utf-8');
    header('Content-Disposition: attachment; filename="Utilisateurs.xml"');
    
    echo $xml->asXML();
    exit;
}