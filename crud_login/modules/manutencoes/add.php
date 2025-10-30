<?php
require_once('functions.php');
add_manutencao();

$veiculos = veiculos_list(); // Lista de veículos com imagem para seleção
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
    <h2>Nova Manutenção</h2>
    <hr>

    <form action="add.php" method="POST">

        <div class="mb-3">
            <label for="veiculo" class="form-label">Veículo</label>
            <select name="manutencao[veiculo_id]" id="veiculo" class="form-select" required>
                <option value="">Selecione...</option>
                <?php foreach ($veiculos as $v): ?>
                    <option value="<?= $v['id'] ?>">
                        <?= htmlspecialchars($v['marca'] . ' ' . $v['modelo'] . ' (' . $v['placa'] . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_servico" class="form-label">Tipo de Serviço</label>
            <input type="text" name="manutencao[tipo_servico]" id="tipo_servico" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="manutencao[descricao]" id="descricao" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor (R$)</label>
            <input type="number" step="0.01" name="manutencao[valor]" id="valor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="data_manutencao" class="form-label">Data da Manutenção</label>
            <input type="date" name="manutencao[data_manutencao]" id="data_manutencao" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="proxima_manutencao" class="form-label">Próxima Manutenção</label>
            <input type="date" name="manutencao[proxima_manutencao]" id="proxima_manutencao" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Manutenção</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
