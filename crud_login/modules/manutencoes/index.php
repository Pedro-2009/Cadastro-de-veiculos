<?php
require_once('functions.php');
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
                <a class="btn btn-primary" href="add.php"><i class="fa fa-plus"></i> Nova Manutenção</a>
                <a class="btn btn-secondary" href="index.php"><i class="fa fa-refresh"></i> Atualizar</a>
            </div>
        </div>
    </header>

    <?php if (!empty($_SESSION['message']) || !empty($_SESSION['messages'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type'] ?? 'info'; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?? $_SESSION['messages'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
        <?php clear_messages(); ?>
    <?php endif; ?>

    <hr>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Imagem</th>
                    <th>ID</th>
                    <th>Veículo</th>
                    <th>Placa</th>
                    <th>Tipo de Serviço</th>
                    <th>Data</th>
                    <th>Valor</th>
                    <th class="text-end">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($manutencoes)) : ?>
                    <?php foreach ($manutencoes as $m) : ?>
                        <tr>
                            <td style="width:80px;">
                                <?php if (!empty($m['imagem'])): ?>
                                    <img src="<?= htmlspecialchars($m['imagem']) ?>" class="img-fluid rounded" alt="Veículo">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/80x60?text=Sem+Imagem" class="img-fluid rounded" alt="Sem imagem">
                                <?php endif; ?>
                            </td>
                            <td><?= $m['id'] ?></td>
                            <td><?= htmlspecialchars($m['marca'] . ' ' . $m['modelo']) ?></td>
                            <td><?= htmlspecialchars($m['placa']) ?></td>
                            <td><?= htmlspecialchars($m['tipo_servico']) ?></td>
                            <td><?= htmlspecialchars($m['data_manutencao']) ?></td>
                            <td>R$<?= number_format($m['valor'], 2, ',', '.') ?></td>
                            <td class="text-end">
                                <a href="view.php?id=<?= $m['id'] ?>" class="btn btn-sm btn-success mb-1"><i class="fa fa-eye"></i> Visualizar</a>
                                <a href="edit.php?id=<?= $m['id'] ?>" class="btn btn-sm btn-warning mb-1"><i class="fa fa-pencil"></i> Editar</a>
                                <button class="btn btn-sm btn-danger mb-1" onclick="openDeleteModal('delete.php?id=<?= $m['id'] ?>')">
                                    <i class="fa fa-trash"></i> Excluir
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Nenhuma manutenção registrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php
    foreach (glob(COMPONENTS_PATH . 'modal/*.php') as $modalFile) {
        include $modalFile;
    }
    ?>
</div>

<?php include(FOOTER_TEMPLATE); ?>
