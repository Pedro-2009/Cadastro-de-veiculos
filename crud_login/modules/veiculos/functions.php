<?php
require_once(__DIR__ . '/../../init.php'); // acesso ao DB e funções globais

$veiculos = null;
$veiculo  = null;

/**
 * Lista todos os veículos
 */
function index_veiculos() {
    global $veiculos;
    $veiculos = find_all_veiculos();
}

/**
 * Busca todos os veículos com nome do cliente
 */
function find_all_veiculos() {
    $conn = open_database();
    $rows = [];

    $sql = "SELECT v.*, c.name AS cliente
            FROM veiculos v
            LEFT JOIN customers c ON v.customer_id = c.id
            ORDER BY v.id DESC";

    if ($result = $conn->query($sql)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    }

    close_database($conn);
    return $rows;
}

/**
 * Busca um veículo pelo ID
 */
function find_veiculo($id) {
    $conn = open_database();
    $stmt = $conn->prepare("SELECT * FROM veiculos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $veiculo = $result->fetch_assoc();
    close_database($conn);
    return $veiculo;
}

/**
 * Salva novo veículo
 */
function add_veiculo() {
    global $veiculo;
    if (!empty($_POST['veiculo'])) {
        $veiculo = $_POST['veiculo'];

        // Upload de imagem
        if (!empty($_FILES['imagem']['name'])) {
            $veiculo['imagem'] = upload_image($_FILES['imagem']);
        }

        save('veiculos', $veiculo);

        $_SESSION['message'] = 'Veículo cadastrado com sucesso!';
        $_SESSION['type'] = 'success';
        header('Location: index.php');
        exit;
    }
}

/**
 * Edita veículo existente
 */
function edit_veiculo() {
    global $veiculo;
    $id = $_GET['id'] ?? null;

    if (!$id) {
        $_SESSION['message'] = 'ID do veículo não informado.';
        $_SESSION['type'] = 'warning';
        header('Location: index.php');
        exit;
    }

    if (!empty($_POST['veiculo'])) {
        $veiculoData = $_POST['veiculo'];

        // Substitui a imagem se houver novo upload
        if (!empty($_FILES['imagem']['name'])) {
            $veiculoAtual = find_veiculo($id);
            if (!empty($veiculoAtual['imagem']) && file_exists('../../' . $veiculoAtual['imagem'])) {
                unlink('../../' . $veiculoAtual['imagem']); // remove imagem antiga
            }
            $veiculoData['imagem'] = upload_image($_FILES['imagem']);
        }

        update('veiculos', $id, $veiculoData);

        $_SESSION['message'] = 'Veículo atualizado com sucesso!';
        $_SESSION['type'] = 'success';
        header('Location: index.php');
        exit;
    } else {
        $veiculo = find_veiculo($id);
    }
}

/**
 * Exclui veículo
 */
function delete_veiculo($id = null) {
    if (!$id) {
        $_SESSION['message'] = 'ID do veículo não informado.';
        $_SESSION['type'] = 'warning';
        header('Location: index.php');
        exit;
    }

    $veiculo = find_veiculo($id);
    if (!empty($veiculo['imagem']) && file_exists('../../' . $veiculo['imagem'])) {
        unlink('../../' . $veiculo['imagem']); // remove imagem ao deletar veículo
    }

    remove('veiculos', $id);

    $_SESSION['message'] = 'Veículo excluído com sucesso!';
    $_SESSION['type'] = 'success';
    header('Location: index.php');
    exit;
}

/**
 * Função de upload de imagem
 */
function upload_image($file) {
    $uploadDir = 'public/uploads/veiculos/';
    if (!is_dir('../../' . $uploadDir)) {
        mkdir('../../' . $uploadDir, 0777, true);
    }

    $filename = 'veiculo_' . time() . '_' . basename($file['name']);
    $targetFile = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], '../../' . $targetFile)) {
        return $targetFile;
    }

    return null;
}

/**
 * Lista todos os clientes para select
 */
function find_all_customers() {
    $conn = open_database();
    $rows = [];
    $sql = "SELECT id, name FROM customers ORDER BY name ASC";
    if ($result = $conn->query($sql)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    }
    close_database($conn);
    return $rows;
}
