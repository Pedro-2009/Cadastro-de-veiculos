<?php require_once('functions.php');
requireAccess(['admin', 'funcionario']);
index();
?>

<?php include(HEADER_TEMPLATE); ?>

<header>
    <div class="row">
        <div class="col-sm-6">
            <h2>Usuários</h2>
        </div>
        <div class="col-sm-6 text-right h2">
            <a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Novo Usuário</a>
            <a class="btn btn-default" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['messages'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['messages']; ?>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<hr>

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th width="25%">Nome</th>
            <th>Username</th>
            <th>e-mail</th>
            <th>Acesso</th>
            <th class="text-center">Atualizado em</th>
            <th>Opções</th>
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
                    <td class="text-center align-middle"><?php echo formatDateTimeForView($user['modified']); ?></td>
                    <td class="actions text-right">
                        <a href="view.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Visualizar</a>
                        <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i> Editar</a>
                        <button class="btn btn-sm btn-info" onclick="openChangePasswordModal(<?= $user['id']; ?>)">
                            <i class="fa fa-key" aria-hidden="true"></i> Alterar Senha
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="openDeleteModal('delete.php?id=<?= $user['id']; ?>')">
                            <i class="fa fa-trash"></i> Excluir
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">Nenhum registro encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
// Inclui todos os modais
foreach (glob(COMPONENTS_PATH . 'modal/*.php') as $modalFile) {
    include $modalFile;
}
?>

<?php include(FOOTER_TEMPLATE); ?>