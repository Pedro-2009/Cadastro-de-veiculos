<?php
/**
 * Funções do módulo de Manutenções
 * Integrado ao sistema via init.php
 */

require_once __DIR__ . '/../../init.php';
require_once __DIR__ . '/../veiculos/functions.php';

// Variáveis globais
$manutencoes = null;
$manutencao  = null;

/**
 * Lista todas as manutenções com informações do veículo
 */
function index_manutencoes() {
    global $manutencoes;
    $manutencoes = find_all_manutencoes();
}

/**
 * Busca todas as manutenções no banco de dados
 */
function find_all_manutencoes() {
    $conn = open_database();
    $rows = [];

    $sql = "SELECT m.*, v.placa, v.modelo, v.marca
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
 * Adiciona nova manutenção
 */
function add_manutencao() {
    if (!empty($_POST['manutencao'])) {
        $manutencao = $_POST['manutencao'];
        save('manutencoes', $manutencao);

        $_SESSION['messages'] = 'Manutenção cadastrada com sucesso!';
        $_SESSION['type'] = 'success';
        header('Location: index.php');
        exit;
    }
}

/**
 * Edita manutenção existente
 */
function edit_manutencao() {
    $id = $_GET['id'] ?? null;

    if (isset($_POST['manutencao'])) {
        $manutencao = $_POST['manutencao'];
        update('manutencoes', $id, $manutencao);

        $_SESSION['messages'] = 'Manutenção atualizada com sucesso!';
        $_SESSION['type'] = 'success';
        header('Location: index.php');
        exit;
    } else {
        global $manutencao;
        $manutencao = find('manutencoes', $id);
    }
}

/**
 * Remove manutenção
 */
function delete_manutencao($id = null) {
    global $manutencao;
    $manutencao = remove('manutencoes', $id);

    $_SESSION['messages'] = 'Manutenção excluída com sucesso!';
    $_SESSION['type'] = 'success';
    header('Location: index.php');
    exit;
}
