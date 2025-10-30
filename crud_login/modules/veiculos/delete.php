<?php
require_once('functions.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['message'] = 'ID do veículo não informado.';
    $_SESSION['type'] = 'warning';
    header('Location: index.php');
    exit;
}

// Busca o veículo antes de excluir para pegar o caminho da imagem
$veiculo = find('veiculos', $id);

// Remove imagem do servidor, se existir
if (!empty($veiculo['imagem']) && file_exists(__DIR__ . '/../../' . $veiculo['imagem'])) {
    unlink(__DIR__ . '/../../' . $veiculo['imagem']);
}

// Executa exclusão no banco
delete_veiculo($id);
