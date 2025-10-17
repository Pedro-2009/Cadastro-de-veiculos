<?php
require_once __DIR__ . '/../../init.php';
require_once __DIR__ . '/functions.php';

// session_start();

// function findUserByLogin($login) {
//   // Simulação: só aceita email "teste@exemplo.com"
//   if ($login === "teste@exemplo.com") {
//     return ['id' => 1, 'email' => $login];
//   }
//   return null;
// }

// function updateUserPassword($userId, $hashedPassword) {
//   // Simulação: aqui você atualizaria no banco
//   return true;
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $step = $_POST['step'] ?? null;

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

  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm_password']);

    if ($password !== $confirm) {
      $_SESSION['messages'] = "As senhas não coincidem.";
      $_SESSION['type'] = "danger";
      header("Location: " . BASEURL . "login.php");
      exit;
    }

    $user = findUserByLogin($email);
    if (!$user) {
      $_SESSION['messages'] = "E-mail não encontrado.";
      $_SESSION['type'] = "danger";
      header("Location: " . BASEURL . "login.php");
      exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    update("users", $user['id'], ["password" => $hashed]);

    $_SESSION['messages'] = "Senha redefinida com sucesso!";
    $_SESSION['type'] = "success";
    header("Location: " . BASEURL . "login.php");
    exit;
  }
}
