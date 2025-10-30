<?php
require_once('functions.php');
edit_veiculo();

$clientes = find_all_customers();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
  <h2>Editar Veículo</h2>
  <hr>

  <form action="edit.php?id=<?= $veiculo['id'] ?>" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="cliente" class="form-label">Cliente</label>
      <select name="veiculo[customer_id]" id="cliente" class="form-select" required>
        <option value="">Selecione...</option>
        <?php foreach ($clientes as $c): ?>
          <option value="<?= $c['id'] ?>" <?= ($c['id'] == $veiculo['customer_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($c['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="marca" class="form-label">Marca</label>
      <input type="text" name="veiculo[marca]" id="marca" class="form-control" value="<?= htmlspecialchars($veiculo['marca']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="modelo" class="form-label">Modelo</label>
      <input type="text" name="veiculo[modelo]" id="modelo" class="form-control" value="<?= htmlspecialchars($veiculo['modelo']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="placa" class="form-label">Placa</label>
      <input type="text" name="veiculo[placa]" id="placa" class="form-control" value="<?= htmlspecialchars($veiculo['placa']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="ano" class="form-label">Ano</label>
      <input type="number" name="veiculo[ano]" id="ano" class="form-control" value="<?= htmlspecialchars($veiculo['ano']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="cor" class="form-label">Cor</label>
      <input type="text" name="veiculo[cor]" id="cor" class="form-control" value="<?= htmlspecialchars($veiculo['cor']) ?>">
    </div>

    <div class="mb-3">
      <label for="imagem" class="form-label">Imagem do Veículo</label>
      <?php if (!empty($veiculo['imagem']) && file_exists('../../' . $veiculo['imagem'])): ?>
        <div class="mb-2">
          <img src="../../<?= $veiculo['imagem'] ?>" alt="Veículo" class="img-fluid rounded" style="max-height: 200px;">
        </div>
      <?php endif; ?>
      <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
      <small class="text-muted">Enviar um novo arquivo substituirá a imagem atual.</small>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
