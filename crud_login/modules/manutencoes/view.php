<?php
require_once('functions.php');

$id = $_GET['id'] ?? null;
if (!$id) {
    $_SESSION['message'] = 'ID da manutenção não informado.';
    $_SESSION['type'] = 'warning';
    header('Location: index.php');
    exit;
}

$manutencao = find('manutencoes', $id);
$veiculo = find('veiculos', $manutencao['veiculo_id']);
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
    <h2>Visualizar Manutenção</h2>
    <hr>

    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['type'] ?? 'info'; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
        <?php clear_messages(); ?>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">

            <!-- Imagem do veículo -->
            <?php if (!empty($veiculo['imagem']) && file_exists(__DIR__ . '/../../' . $veiculo['imagem'])): ?>
                <div class="mb-3 text-center">
                    <img src="<?= '../../' . $veiculo['imagem'] ?>" 
                         alt="Imagem do Veículo" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                </div>
            <?php endif; ?>

            <dl class="row">
                <dt class="col-sm-3">Veículo</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo'] . ' (' . $veiculo['placa'] . ')') ?></dd>

                <dt class="col-sm-3">Tipo de Serviço</dt>
                <dd class="col-sm-9"><?= htmlspecialchars($manutencao['tipo_servico']) ?></dd>

                <dt class="col-sm-3">Descrição</dt>
                <dd class="col-sm-9"><?= nl2br(htmlspecialchars($manutencao['descricao'])) ?></dd>

                <dt class="col-sm-3">Valor</dt>
                <dd class="col-sm-9">R$ <?= number_format($manutencao['valor'], 2, ',', '.') ?></dd>

                <dt class="col-sm-3">Data da Manutenção</dt>
                <dd class="col-sm-9"><?= $manutencao['data_manutencao'] ?></dd>

                <dt class="col-sm-3">Próxima Manutenção</dt>
                <dd class="col-sm-9"><?= $manutencao['proxima_manutencao'] ?? '—' ?></dd>
            </dl>

            <a href="edit.php?id=<?= $manutencao['id'] ?>" class="btn btn-warning">
                <i class="fa fa-pencil"></i> Editar
            </a>
            <button class="btn btn-danger" onclick="openDeleteModal('delete.php?id=<?= $manutencao['id'] ?>')">
                <i class="fa fa-trash"></i> Excluir
            </button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
