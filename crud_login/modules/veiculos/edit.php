<?php
require_once('functions.php');
require_once __DIR__ . '/../customers/functions.php';

// Verifica se o ID foi passado
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

// Busca veículo específico
$veiculo = find('veiculos', $id);

// Busca todos os clientes para o select
$clientes = find_all_customers();

// Processa o formulário de edição
if (!empty($_POST['veiculo'])) {
    $veiculo_atualizado = $_POST['veiculo'];

    update('veiculos', $id, $veiculo_atualizado);

    $_SESSION['message'] = 'Veículo atualizado com sucesso!';
    $_SESSION['type'] = 'success';
    header('Location: index.php');
    exit;
}
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
  <h2 class="mb-4">Editar Veículo</h2>
  <hr>

  <form action="edit.php?id=<?= $id ?>" method="post">
    <div class="mb-3">
      <label for="cliente_id" class="form-label">Cliente</label>
      <select name="veiculo[customer_id]" id="cliente_id" class="form-select" required>
        <option value="">Selecione um cliente</option>
        <?php foreach ($clientes as $cliente): ?>
          <option value="<?= $cliente['id'] ?>" <?= ($veiculo['customer_id'] == $cliente['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($cliente['name']) ?>
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

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="index.php" class="btn btn-secondary ms-2">Cancelar</a>
  </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
