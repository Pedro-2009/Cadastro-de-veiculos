<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/../veiculos/functions.php';
$veiculos = veiculos_find_all();
add_manutencao();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
  <h2 class="mb-4">Nova Manutenção</h2>
  <hr>

  <form action="add.php" method="post">
    <div class="mb-3">
      <label for="veiculo_id" class="form-label">Veículo</label>
      <select name="manutencao[veiculo_id]" id="veiculo_id" class="form-select" required>
        <option value="">Selecione um veículo</option>
        <?php foreach ($veiculos as $v) : ?>
          <option value="<?= $v['id']; ?>">
            <?= htmlspecialchars($v['placa'] . ' - ' . $v['modelo'] . ' (' . $v['marca'] . ')'); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição</label>
      <textarea name="manutencao[descricao]" id="descricao" class="form-control" required></textarea>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="data_manutencao" class="form-label">Data</label>
        <input type="date" name="manutencao[data_manutencao]" id="data_manutencao" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="valor" class="form-label">Valor (R$)</label>
        <input type="number" step="0.01" name="manutencao[valor]" id="valor" class="form-control" required>
      </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
      <a href="index.php" class="btn btn-secondary me-2">Cancelar</a>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
  </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
