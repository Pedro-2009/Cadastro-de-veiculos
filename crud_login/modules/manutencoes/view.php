<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/../veiculos/functions.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

// Busca manutenção específica
$manutencao = find('manutencoes', $id);

// Busca dados do veículo relacionado
$veiculo = find('veiculos', $manutencao['veiculo_id']);
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
  <h2 class="mb-4">Detalhes da Manutenção</h2>
  <hr>

  <?php if ($manutencao) : ?>
    <div class="card shadow-sm rounded-3">
      <div class="card-body">
        <h5 class="card-title mb-3">Veículo</h5>
        <p class="card-text">
          <strong>Placa:</strong> <?= htmlspecialchars($veiculo['placa']); ?><br>
          <strong>Modelo:</strong> <?= htmlspecialchars($veiculo['modelo']); ?><br>
          <strong>Marca:</strong> <?= htmlspecialchars($veiculo['marca']); ?>
        </p>

        <hr>

        <h5 class="card-title mb-3">Informações da Manutenção</h5>
        <p class="card-text">
          <strong>Descrição:</strong><br>
          <?= nl2br(htmlspecialchars($manutencao['descricao'])); ?><br><br>

          <strong>Data:</strong> <?= date('d/m/Y', strtotime($manutencao['data_manutencao'])); ?><br>
          <strong>Valor:</strong> R$ <?= number_format($manutencao['valor'], 2, ',', '.'); ?>
        </p>
      </div>
    </div>

    <div class="mt-4 d-flex justify-content-end">
      <a href="edit.php?id=<?= $manutencao['id']; ?>" class="btn btn-primary me-2">Editar</a>
      <a href="delete.php?id=<?= $manutencao['id']; ?>" class="btn btn-danger"
         onclick="return confirm('Tem certeza que deseja excluir esta manutenção?');">Excluir</a>
      <a href="index.php" class="btn btn-secondary ms-2">Voltar</a>
    </div>

  <?php else : ?>
    <div class="alert alert-warning">Manutenção não encontrada.</div>
    <a href="index.php" class="btn btn-secondary mt-3">Voltar</a>
  <?php endif; ?>
</div>

<?php include(FOOTER_TEMPLATE); ?>
