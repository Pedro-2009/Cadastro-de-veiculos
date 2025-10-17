<?php
require_once('functions.php');
index();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">

  <header class="mb-3">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <h2>Usuários</h2>
      </div>
      <div class="col-sm-6 d-flex justify-content-end gap-2">
        <a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Usuário</a>
        <a class="btn btn-secondary" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
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
          <th>Nome</th>
          <th>Usuário</th>
          <th>Email</th>
          <th>Nível</th>
          <th>Atualizado em</th>
          <th class="text-end">Opções</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($users) : ?>
          <?php foreach ($users as $user) : ?>
            <tr>
              <td><?php echo $user['id']; ?></td>
              <td><?php echo $user['name']; ?></td>
              <td><?php echo $user['username']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td><?php echo $user['access_level']; ?></td>
              <td><?php echo formatDateTimeForView($user['modified']); ?></td>
              <td class="text-end">
                <a href="view.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-success mb-1"><i class="fa fa-eye"></i> Visualizar</a>
                <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-warning mb-1"><i class="fa fa-pencil"></i> Editar</a>
                <button class="btn btn-sm btn-danger mb-1" onclick="openDeleteModal('delete.php?id=<?= $user['id']; ?>')">
                  <i class="fa fa-trash"></i> Excluir
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="7" class="text-center">Nenhum registro encontrado.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php
  // Inclui todos os modais
  foreach (glob(COMPONENTS_PATH . 'modal/*.php') as $modalFile) {
      include $modalFile;
  }
  ?>

</div>

<?php include(FOOTER_TEMPLATE); ?>
