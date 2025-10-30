<?php
require_once('functions.php');
index_veiculos();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">

  <header class="mb-3">
    <div class="row align-items-center">
      <div class="col-sm-6"><h2>Veículos</h2></div>
      <div class="col-sm-6 d-flex justify-content-end gap-2">
        <a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Veículo</a>
        <a class="btn btn-secondary" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
      </div>
    </div>
  </header>

<?php if (isset($_SESSION['message']) && trim($_SESSION['message']) !== '') : ?>
    <div class="alert alert-<?= $_SESSION['type'] ?? 'info'; ?> alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['message']) ?>
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
          <th>Imagem</th>
          <th>Cliente</th>
          <th>Marca</th>
          <th>Modelo</th>
          <th>Placa</th>
          <th>Ano</th>
          <th>Cor</th>
          <th>Data de Cadastro</th>
          <th class="text-end">Opções</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($veiculos)) : ?>
          <?php foreach ($veiculos as $v) : ?>
            <tr>
              <td><?= $v['id'] ?></td>
              <td>
                <?php if (!empty($v['imagem'])): ?>
                  <img src="<?= $v['imagem'] ?>" class="img-fluid" style="max-width:80px;" alt="Veículo">
                <?php else: ?>
                  —
                <?php endif; ?>
              </td>
              <td><?= htmlspecialchars($v['cliente'] ?? '—') ?></td>
              <td><?= htmlspecialchars($v['marca']) ?></td>
              <td><?= htmlspecialchars($v['modelo']) ?></td>
              <td><?= htmlspecialchars($v['placa']) ?></td>
              <td><?= htmlspecialchars($v['ano']) ?></td>
              <td><?= htmlspecialchars($v['cor']) ?></td>
              <td><?= $v['data_cadastro'] ?></td>
              <td class="text-end">
                <a href="view.php?id=<?= $v['id'] ?>" class="btn btn-sm btn-success mb-1"><i class="fa fa-eye"></i> Visualizar</a>
                <a href="edit.php?id=<?= $v['id'] ?>" class="btn btn-sm btn-warning mb-1"><i class="fa fa-pencil"></i> Editar</a>
                <button class="btn btn-sm btn-danger mb-1" onclick="openDeleteModal('delete.php?id=<?= $v['id'] ?>')">
                  <i class="fa fa-trash"></i> Excluir
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="10" class="text-center">Nenhum veículo cadastrado.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php foreach (glob(COMPONENTS_PATH . 'modal/*.php') as $modalFile) {
      include $modalFile;
  } ?>

</div>

<?php include(FOOTER_TEMPLATE); ?>
