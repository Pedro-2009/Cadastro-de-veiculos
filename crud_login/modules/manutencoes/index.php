<?php
require_once __DIR__ . '/functions.php';
index_manutencoes();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">

  <header class="mb-3">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <h2>Manutenções</h2>
      </div>
      <div class="col-sm-6 d-flex justify-content-end gap-2">
        <a class="btn btn-primary" href="add.php">
          <i class="fa fa-plus"></i> Nova Manutenção
        </a>
        <a class="btn btn-secondary" href="index.php">
          <i class="fa fa-refresh"></i> Atualizar
        </a>
      </div>
    </div>
  </header>

  <?php if (!empty($_SESSION['messages'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['messages']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    <?php clear_messages(); ?>
  <?php endif; ?>

  <hr>

  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Veículo</th>
          <th>Descrição</th>
          <th>Data</th>
          <th>Valor (R$)</th>
          <th class="text-end">Opções</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($manutencoes)) : ?>
          <?php foreach ($manutencoes as $manutencao) : ?>
            <tr>
              <td><?php echo $manutencao['id']; ?></td>
              <td>
                <?php echo htmlspecialchars($manutencao['placa'] ?? '—'); ?>
                <br>
                <small><?php echo htmlspecialchars($manutencao['modelo'] ?? ''); ?> - <?php echo htmlspecialchars($manutencao['marca'] ?? ''); ?></small>
              </td>
              <td><?php echo htmlspecialchars($manutencao['descricao']); ?></td>
              <td><?php echo date('d/m/Y', strtotime($manutencao['data_manutencao'])); ?></td>
              <td><?php echo number_format($manutencao['valor'], 2, ',', '.'); ?></td>
              <td class="text-end">
                <a href="view.php?id=<?php echo $manutencao['id']; ?>" class="btn btn-sm btn-success mb-1">
                  <i class="fa fa-eye"></i> Visualizar
                </a>
                <a href="edit.php?id=<?php echo $manutencao['id']; ?>" class="btn btn-sm btn-warning mb-1">
                  <i class="fa fa-pencil"></i> Editar
                </a>
                <button class="btn btn-sm btn-danger mb-1"
                        onclick="openDeleteModal('delete.php?id=<?= $manutencao['id']; ?>')">
                  <i class="fa fa-trash"></i> Excluir
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="6" class="text-center">Nenhuma manutenção cadastrada.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php
  // Inclui todos os modais disponíveis (confirmação de exclusão, etc)
  foreach (glob(COMPONENTS_PATH . 'modal/*.php') as $modalFile) {
      include $modalFile;
  }
  ?>

</div>

<?php include(FOOTER_TEMPLATE); ?>
