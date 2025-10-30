<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/../veiculos/functions.php';
$veiculos = veiculos_find_all();
edit_manutencao();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
  <h2 class="mb-4">Editar Manutenção</h2>
  <hr>

  <form action="edit.php?id=<?php echo $manutencao['id']; ?>" method="post">
    <input type="hidden" name="manutencao[id]" value="<?php echo $manutencao['id']; ?>">

    <div class="mb-3">
      <label for="veiculo_id" class="form-label">Veículo</label>
      <select name="manutencao[veiculo_id]" id="veiculo_id" class="form-select" required>
        <?php foreach ($veiculos as $v) : ?>
          <option value="<?= $v['id']; ?>" <?= ($v['id'] == $manutencao['veiculo_id']) ? 'selected' : ''; ?>>
            <?= htmlspecialchars($v['placa'] . ' - ' . $v['modelo'] . ' (' . $v['marca'] . ')'); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="descricao" class="form-label">Descrição</label>
      <textarea name="manutencao[descricao]" id="descricao" class="form-control" required><?php echo htmlspecialchars($manutencao['descricao']); ?></textarea>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="data_manutencao" class="form-label">Data</label>
        <input type="date" name="manutencao[data_manutencao]" id="data_manutencao"
               value="<?php echo $manutencao['data_manutencao']; ?>" class="form-control" required>
      </div>
      <div class="col-md-6 mb-3">
        <label for="valor" class="form-label">Valor (R$)</label>
        <input type="number" step="0.01" name="manutencao[valor]" id="valor"
               value="<?php echo $manutencao['valor']; ?>" class="form-control" required>
      </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
      <a href="index.php" class="btn btn-secondary me-2">Cancelar</a>
      <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </div>
  </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
