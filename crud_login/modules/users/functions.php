<?php 
require_once __DIR__ . '/../../init.php';

$users = null;
$user = null;

/* Listagem de Clientes */ 
function index() {
    global $users;
    $users = find_all('users');
}

/*  Cadastro de Clientes */
function add() {
    if (!empty($_POST['user'])) {
        $user = $_POST['user'];
        $password = trim($user['password']);
        $confirm_password = trim($user['confirm_password']);

        // Validação de senha
        if ($password !== $confirm_password) {
            $_SESSION['messages'] = 'As senhas não coincidem.';
            $_SESSION['type'] = 'danger';
            header('Location: add.php');
            exit;
        }

        // Verificar conflitos de username e email
        if (findUserByLogin($user['username']) || findUserByLogin($user['email'])) {
            $_SESSION['messages'] = 'Usuário ou E-mail já cadastrados.';
            $_SESSION['type'] = 'danger';
            header('Location: add.php');
            exit;
        }

        $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
        $user['created'] = $today->format("Y-m-d H:i:s");

        if (!empty($user['password'])) {
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
        }

        save('users', $user);
        header('location: index.php');
        exit;
    }
}

/* Auto registro de Usuários */
function register() {
    if (!empty($_POST['user'])) {
        $user = $_POST['user'];
        $password = trim($user['password']);
        $confirm_password = trim($user['confirm_password']);

        // Validação de senha
        if ($password !== $confirm_password) {
            $_SESSION['messages'] = 'As senhas não coincidem.';
            $_SESSION['type'] = 'danger';
            return;
        }

        // Verificar se username ou email já existem
        if (findUserByLogin($user['username']) || findUserByLogin($user['email'])) {
            $_SESSION['messages'] = 'Usuário ou E-mail já cadastrados.';
            $_SESSION['type'] = 'danger';
            return;
        }

        $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
        $user['created'] = $today->format("Y-m-d H:i:s");

        // Hash da senha
        if (!empty($user['password'])) {
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
        }

        // Salva no banco
        save('users', $user);

        // Mensagem de sucesso
        $_SESSION['messages'] = 'Cadastro realizado com sucesso!';
        $_SESSION['type'] = 'success';
    }
}

/* Função auxiliar para gerar o JS do modal */
function modalResultScript($result) {
    return "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('modalTitle').innerText = '{$result['title']}';
            document.getElementById('modalMessage').innerText = '{$result['message']}';
            $('#resultModal').modal('show');
            document.getElementById('modalOkBtn').addEventListener('click', function() {
                window.location.href = '../login.php';
            });
        });
    </script>";
}

/*	Atualizacao/Edicao de Cliente */
function edit() {

    $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['user'])) {

            $user = $_POST['user'];

            // Verificação de username já existente (exceto o próprio usuário)
            $existingUser = findUserByLogin($user['username']);
            if ($existingUser && $existingUser['id'] != $id) {
                $_SESSION['messages'] = 'Username já existe.';
                $_SESSION['type'] = 'danger';
                return; // não executa o update
            }

            // Verificação de email já existente (exceto o próprio usuário)
            $existingEmail = findUserByLogin($user['email']);
            if ($existingEmail && $existingEmail['id'] != $id) {
                $_SESSION['messages'] = 'E-mail já existe.';
                $_SESSION['type'] = 'danger';
                return; // não executa o update
            }

            update('users', $id, $user);
            header('location: index.php');
        } else {
            global $user;
            $user = find('users', $id);
        }  

    } else {
        header('location: index.php');
    }
}


/* Visualização de um Cliente */
function view($id = null) {
    global $user;

    $user = find('users', $id);
}

/* Exclusão de um Cliente */
function delete($id = null) {

    global $user;

    $user = remove('users', $id);

    header('location: index.php');
}