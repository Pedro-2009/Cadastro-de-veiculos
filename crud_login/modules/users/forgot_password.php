<?php
require_once __DIR__ . '/../../init.php';
require_once __DIR__ . '/functions.php';

// ⚡ Garante que a sessão está ativa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ⚡ Exibe erros temporariamente (para debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $step = $_POST['step'] ?? null;

    // =========================
    // Etapa 1: Validação do e-mail via AJAX
    // =========================
    if ($step === "checkEmail" && !empty($_POST['email'])) {
        header('Content-Type: application/json; charset=utf-8');

        $email = trim($_POST['email']);
        $user = findUserByLogin($email);

        if ($user) {
            echo json_encode(["status" => "success", "message" => "E-mail válido."]);
        } else {
            echo json_encode(["status" => "error", "message" => "E-mail não encontrado."]);
        }
        exit;
    }

    // =========================
    // Etapa 2: Redefinição de senha
    // =========================
    $email = $_POST['hidden_email'] ?? null;
    $password = $_POST['password'] ?? null;
    $confirm = $_POST['confirm_password'] ?? null;

    if ($email && $password && $confirm) {

        // Validação de senha
        if ($password !== $confirm) {
            $_SESSION['messages'] = "As senhas não coincidem.";
            $_SESSION['type'] = "danger";
            header("Location: " . BASEURL . "login.php");
            exit;
        }

        // Busca usuário
        $user = findUserByLogin($email);
        if (!$user) {
            $_SESSION['messages'] = "E-mail não encontrado.";
            $_SESSION['type'] = "danger";
            header("Location: " . BASEURL . "login.php");
            exit;
        }

        // Atualiza senha com tratamento de erro
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        try {
            $updated = update("users", $user['id'], ["password" => $hashed]);
            if ($updated) {
                $_SESSION['messages'] = "Senha redefinida com sucesso!";
                $_SESSION['type'] = "success";
            } else {
                $_SESSION['messages'] = "Erro ao redefinir senha. Tente novamente.";
                $_SESSION['type'] = "danger";
            }
        } catch (Exception $e) {
            $_SESSION['messages'] = "Erro interno: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }

        header("Location: " . BASEURL . "login.php");
        exit;
    }
}
