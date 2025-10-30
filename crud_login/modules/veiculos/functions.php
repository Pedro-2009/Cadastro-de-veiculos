<?php
/**
 * Funções do módulo de Veículos
 * Integrado via init.php
 */

require_once('../../init.php'); // acesso às funções globais e DBAPI

// Variáveis globais usadas nas views
$veiculos = null;
$veiculo  = null;

/**
 * Lista todos os veículos
 */
function veiculos_index() {
    global $veiculos;
    $veiculos = veiculos_find_all();
}

/**
 * Busca todos os veículos com o nome do cliente vinculado
 */
function veiculos_find_all() {
    $conn = open_database();
    $rows = [];

    if (!$conn) {
        $_SESSION['message'] = 'Erro ao conectar ao banco de dados!';
        $_SESSION['type'] = 'danger';
        return $rows;
    }

    $sql = "SELECT v.*, c.name AS cliente
            FROM veiculos v
            LEFT JOIN customers c ON v.customer_id = c.id
            ORDER BY v.id DESC";

    if ($result = $conn->query($sql)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    } else {
        $_SESSION['message'] = 'Erro ao buscar veículos!';
        $_SESSION['type'] = 'danger';
    }

    close_database($conn);
    return $rows;
}

/**
 * Busca todos os clientes para popular o select em add/edit
 */
function veiculos_find_all_customers() {
    $conn = open_database();
    $rows = [];

    if (!$conn) return $rows;

    $sql = "SELECT id, name FROM customers ORDER BY name ASC";

    if ($result = $conn->query($sql)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    }

    close_database($conn);
    return $rows;
}

/**
 * Cadastra um novo veículo
 */
function veiculos_add() {
    if (!empty($_POST['veiculo'])) {
        $data = $_POST['veiculo'];

        $veiculo = [
            'customer_id'   => $data['customer_id'] ?? null,
            'placa'         => $data['placa'] ?? '',
            'modelo'        => $data['modelo'] ?? '',
            'marca'         => $data['marca'] ?? '',
            'ano'           => $data['ano'] ?? '',
            'cor'           => $data['cor'] ?? '',
            'data_cadastro' => date('Y-m-d H:i:s')
        ];

        save('veiculos', $veiculo);

        $_SESSION['message'] = 'Veículo cadastrado com sucesso!';
        $_SESSION['type'] = 'success';
        header('Location: index.php');
        exit;
    }
}

/**
 * Edita um veículo existente
 */
function veiculos_edit() {
    global $veiculo;
    $id = $_GET['id'] ?? null;
    if (!$id) return;

    if (!empty($_POST['veiculo'])) {
        $data = $_POST['veiculo'];

        $veiculoData = [
            'customer_id' => $data['customer_id'] ?? null,
            'placa'       => $data['placa'] ?? '',
            'modelo'      => $data['modelo'] ?? '',
            'marca'       => $data['marca'] ?? '',
            'ano'         => $data['ano'] ?? '',
            'cor'         => $data['cor'] ?? ''
        ];

        update('veiculos', $id, $veiculoData);

        $_SESSION['message'] = 'Veículo atualizado com sucesso!';
        $_SESSION['type'] = 'success';
        header('Location: index.php');
        exit;
    } else {
        $veiculo = find('veiculos', $id);
    }
}

/**
 * Exclui um veículo
 */
function veiculos_delete($id = null) {
    if (!$id) return;

    remove('veiculos', $id);

    $_SESSION['message'] = 'Veículo excluído com sucesso!';
    $_SESSION['type'] = 'success';
    header('Location: index.php');
    exit;
}
