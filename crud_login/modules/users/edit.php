<?php
require_once('functions.php');
edit();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Atualizar Cliente</h2>

<form action="edit.php?id=<?php echo $user['id']; ?>" method="post">
    <hr />

    <div class="row">
        <div class="form-group col-md-6">
            <label for="campo1">Nome completo</label>
            <input type="text" class="form-control" name="user['name']" value="<?php echo $user['name']; ?>">
        </div>

        <div class="form-group col-md-4">
            <label for="username">Usuário</label>
            <input type="text" class="form-control" name="user['username']" value="<?php echo $user['username']; ?>">
        </div>

    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="user['email']" value="<?php echo $user['email']; ?>">
        </div>

        <div class="form-group col-md-4">
            <label for="access_level">Nível de Acesso</label>
            <select class="form-control" name="user['access_level']" required>
                <option value="" disabled selected>Selecione</option>
                <option value="admin" <?php echo ($user['access_level'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                <option value="funcionario" <?php echo ($user['access_level'] == 'funcionario') ? 'selected' : ''; ?>>Funcionário</option>
                <option value="cliente" <?php echo ($user['access_level'] == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
            </select>
        </div>
    </div>

    <div id="actions" class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-default">Cancelar</a>
        </div>
    </div>
</form>
<?php include(FOOTER_TEMPLATE); ?>