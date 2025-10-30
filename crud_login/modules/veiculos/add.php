<?php
require_once('functions.php');
add_veiculo();

$clientes = find_all_customers(); // Para selecionar cliente no cadastro
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
  <h2>Novo Veículo</h2>
  <hr>

  <form action="add.php" method="POST" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="cliente" class="form-label">Cliente</label>
      <select name="veiculo[customer_id]" id="cliente" class="form-select" required>
        <option value="">Selecione...</option>
        <?php foreach ($clientes as $c): ?>
          <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="marca" class="form-label">Marca</label>
      <input type="text" name="veiculo[marca]" id="marca" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="modelo" class="form-label">Modelo</label>
      <input type="text" name="veiculo[modelo]" id="modelo" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="placa" class="form-label">Placa</label>
      <input type="text" name="veiculo[placa]" id="placa" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="ano" class="form-label">Ano</label>
      <input type="number" name="veiculo[ano]" id="ano" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="cor" class="form-label">Cor</label>
      <input type="text" name="veiculo[cor]" id="cor" class="form-control">
    </div>

    <div class="mb-3">
      <label for="imagem" class="form-label">Imagem do Veículo</label>
      <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar Veículo</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
