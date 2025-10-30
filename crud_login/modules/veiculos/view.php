<?php
require_once('functions.php');
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}
$veiculo = find_veiculo($id);
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
  <h2>Visualizar Veículo</h2>
  <hr>

  <div class="mb-3">
    <strong>Cliente:</strong> <?= htmlspecialchars($veiculo['cliente'] ?? '—') ?>
  </div>
  <div class="mb-3">
    <strong>Marca:</strong> <?= htmlspecialchars($veiculo['marca']) ?>
  </div>
  <div class="mb-3">
    <strong>Modelo:</strong> <?= htmlspecialchars($veiculo['modelo']) ?>
  </div>
  <div class="mb-3">
    <strong>Placa:</strong> <?= htmlspecialchars($veiculo['placa']) ?>
  </div>
  <div class="mb-3">
    <strong>Ano:</strong> <?= htmlspecialchars($veiculo['ano']) ?>
  </div>
  <div class="mb-3">
    <strong>Cor:</strong> <?= htmlspecialchars($veiculo['cor']) ?>
  </div>
  <div class="mb-3">
    <strong>Data de Cadastro:</strong> <?= $veiculo['data_cadastro'] ?>
  </div>

  <?php if (!empty($veiculo['imagem']) && file_exists('../../' . $veiculo['imagem'])): ?>
    <div class="mb-3">
      <strong>Imagem do Veículo:</strong>
      <div>
        <img src="../../<?= $veiculo['imagem'] ?>" alt="Veículo" class="img-fluid rounded" style="max-height: 300px;">
      </div>
    </div>
  <?php endif; ?>

  <a href="index.php" class="btn btn-secondary">Voltar</a>
</div>

<?php include(FOOTER_TEMPLATE); ?>
