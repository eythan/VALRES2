<?php
require __DIR__ . '/../models/AuthModel.php';
require __DIR__ . '/../models/JournalModel.php';
require __DIR__ . '/../models/SessionModel.php';
$action = $_GET['action'] ?? 'login';

if ($action === 'login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = $_POST['login'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($login && $password) {
            $user = getUserByLogin($pdo, $login);
            if ($user && password_verify($password, $user['mot_de_passe'])) {
                $_SESSION['user_id'] = $user['id_utilisateur'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_nom'] = $user['nom'];
                $_SESSION['user_prenom'] = $user['prenom'];
                logActivite($pdo, $user['id_utilisateur'], 'Connexion', 'Connexion réussie', $_SERVER['REMOTE_ADDR']);
                creerSession($pdo, session_id(), $user['id_utilisateur']);
                header("Location: index.php?controller=reservation&action=index");
                exit;
            } else {
                $error = "Identifiant ou mot de passe incorrect";
            }
        } else {
            $error = "Veuillez remplir tous les champs";
        }
    }
    require __DIR__ . '/../views/auth/login.php';
}

if ($action == 'logout') {
    logActivite($pdo, $_SESSION['user_id'], 'Déconnexion', 'Déconnexion volontaire', $_SERVER['REMOTE_ADDR']);
    supprimerSession($pdo, session_id());
    session_destroy();
    header("Location: index.php?controller=auth&action=login");
    exit;
}