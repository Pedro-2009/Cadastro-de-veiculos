<?php
require_once('functions.php');

// Recupera o veículo pelo ID
$id = $_GET['id'] ?? null;
$veiculo = find('veiculos', $id);

?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">

  <header class="mb-3">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <h2>Visualizar Veículo</h2>
      </div>
      <div class="col-sm-6 d-flex justify-content-end gap-2">
        <a href="index.php" class="btn btn-secondary">
          <i class="fa fa-arrow-left"></i> Voltar
        </a>
        <a href="edit.php?id=<?php echo $veiculo['id']; ?>" class="btn btn-warning">
          <i class="fa fa-pencil"></i> Editar
        </a>
      </div>
    </div>
  </header>

  <?php if (!empty($veiculo)) : ?>
    <div class="card mb-4">
      <div class="card-body">
        <p><strong>ID:</strong> <?php echo $veiculo['id']; ?></p>
        <p><strong>Cliente:</strong> <?php echo htmlspecialchars($veiculo['cliente'] ?? '—'); ?></p>
        <p><strong>Marca:</strong> <?php echo htmlspecialchars($veiculo['marca']); ?></p>
        <p><strong>Modelo:</strong> <?php echo htmlspecialchars($veiculo['modelo']); ?></p>
        <p><strong>Placa:</strong> <?php echo htmlspecialchars($veiculo['placa']); ?></p>
        <p><strong>Ano:</strong> <?php echo htmlspecialchars($veiculo['ano']); ?></p>
        <p><strong>Cor:</strong> <?php echo htmlspecialchars($veiculo['cor']); ?></p>
      </div>
    </div>
  <?php else : ?>
    <div class="alert alert-warning">
      Veículo não encontrado.
    </div>
  <?php endif; ?>

</div>

<?php include(FOOTER_TEMPLATE); ?>
