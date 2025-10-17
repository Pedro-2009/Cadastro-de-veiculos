<?php
require_once __DIR__ . '/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($login) || empty($password)) {
        $_SESSION['messages'] = 'Preencha todos os campos.';
        $_SESSION['type'] = 'danger';
        header('Location: ' . BASEURL . 'login.php');
        exit;
    }

    $user = findUserByLogin($login);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'username' => $user['username'],
            'email' => $user['email'],
            'access_level' => $user['access_level'],
            'created' => $user['created'],
            'modified' => $user['modified']
        ];

        header('Location: ' . BASEURL . 'index.php');
        exit;
    } else {
        $_SESSION['messages'] = 'Usuário/e-mail ou senha inválidos.';
        $_SESSION['type'] = 'danger';
        header('Location: ' . BASEURL . 'login.php');
        exit;
    }
}

