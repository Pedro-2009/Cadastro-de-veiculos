<?php
require_once(__DIR__ . '/../../init.php'); // acesso ao DB e funções globais

$manutencoes = null;
$manutencao  = null;

/**
 * Lista todas as manutenções
 */
function index_manutencoes() {
    global $manutencoes;
    $manutencoes = find_all_manutencoes();
}

/**
 * Busca todas as manutenções com dados do veículo e imagem
 */
function find_all_manutencoes() {
    $conn = open_database();
    $rows = [];

    $sql = "SELECT m.*, v.marca, v.modelo, v.placa, v.imagem 
            FROM manutencoes m
            LEFT JOIN veiculos v ON m.veiculo_id = v.id
            ORDER BY m.id DESC";

    if ($result = $conn->query($sql)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    }

    close_database($conn);
    return $rows;
}

/**
 * Salva nova manutenção
 */
function add_manutencao() {
    global $manutencao;
    if (!empty($_POST['manutencao'])) {
        $manutencao = $_POST['manutencao'];
        save('manutencoes', $manutencao);

        $_SESSION['message'] = 'Manutenção cadastrada com sucesso!';
        $_SESSION['type'] = 'success';
        header('Location: index.php');
        exit;
    }
}

/**
 * Edita manutenção existente
 */
function edit_manutencao() {
    global $manutencao;
    $id = $_GET['id'] ?? null;

    if (!$id) {
        $_SESSION['message'] = 'ID da manutenção não informado.';
        $_SESSION['type'] = 'warning';
        header('Location: index.php');
        exit;
    }

    if (!empty($_POST['manutencao'])) {
        $manutencao = $_POST['manutencao'];
        update('manutencoes', $id, $manutencao);

        $_SESSION['message'] = 'Manutenção atualizada com sucesso!';
        $_SESSION['type'] = 'success';
        header('Location: index.php');
        exit;
    } else {
        $manutencao = find('manutencoes', $id);
    }
}

/**
 * Exclui manutenção
 */
function delete_manutencao($id = null) {
    global $manutencao;
    if (!$id) {
        $_SESSION['message'] = 'ID da manutenção não informado.';
        $_SESSION['type'] = 'warning';
        header('Location: index.php');
        exit;
    }

    $manutencao = remove('manutencoes', $id);

    $_SESSION['message'] = 'Manutenção excluída com sucesso!';
    $_SESSION['type'] = 'success';
    header('Location: index.php');
    exit;
}

/**
 * Lista todos os veículos (para seleção no add/edit)
 */
function veiculos_list() {
    $conn = open_database();
    $rows = [];

    $sql = "SELECT id, marca, modelo, placa, imagem FROM veiculos ORDER BY marca, modelo";

    if ($result = $conn->query($sql)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    }

    close_database($conn);
    return $rows;
}
