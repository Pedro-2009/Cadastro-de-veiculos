<?php
require_once('functions.php');
require_once __DIR__ . '/../customers/functions.php';

// Busca todos os clientes para o select
$clientes = find_all_customers();

// Processa o formulário
if (!empty($_POST['veiculo'])) {
    $veiculo = $_POST['veiculo'];

    // Adiciona o veículo
    save('veiculos', $veiculo);

    $_SESSION['message'] = 'Veículo cadastrado com sucesso!';
    $_SESSION['type'] = 'success';
    header('Location: index.php');
    exit;
}
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
  <h2 class="mb-4">Cadastrar Novo Veículo</h2>
  <hr>

  <form action="add.php" method="post">
    <div class="mb-3">
      <label for="cliente_id" class="form-label">Cliente</label>
      <select name="veiculo[customer_id]" id="cliente_id" class="form-select" required>
        <option value="">Selecione um cliente</option>
        <?php foreach ($clientes as $cliente): ?>
          <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['name']) ?></option>
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

    <button type="submit" class="btn btn-primary">Cadastrar Veículo</button>
    <a href="index.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
