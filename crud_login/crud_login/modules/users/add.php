<?php require_once('functions.php');
requireAccess(['admin', 'funcionario']);
add();
?>

<?php include(HEADER_TEMPLATE); ?>

<h2>Novo Usuário</h2>

<form action="add.php" method="post">
    <div class="row">
        <div class="form-group col-md-8">
            <label for="name">Nome completo</label>
            <input type="text" class="form-control" name="user['name']" required>
        </div>

        <div class="form-group col-md-4">
            <label for="username">Usuário</label>
            <input type="text" class="form-control" name="user['username']" required>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-8">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="user['email']" required>
        </div>

        <div class="form-group  col-md-4">
            <label for="access_level">Nível de Acesso</label>
            <select class="form-control" name="user['access_level']" required>
                <option value="" disabled selected>Selecione</option>
                <option value="admin">Administrador</option>
                <option value="funcionario">Funcionário</option>
                <option value="cliente">Cliente</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="password">Senha</label>
                <div class="password-wrapper">
                    <input type="password" id="password" class="form-control" name="user[password]" required />
                    <button type="button" class="toggle-password" data-target="#password">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                <div class="password-strength" id="passwordStrength"></div>
                <small id="passwordStrengthText" class="text-muted"></small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="confirm_password">Confirmar Senha</label>
                <div class="password-wrapper">
                    <input type="password" id="confirm_password" class="form-control" name="user[confirm_password]" required />
                    <button type="button" class="toggle-password" data-target="#confirm_password">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                <div class="password-strength" id="confirmStrength"></div>
                <small id="confirmStrengthText" class="text-muted"></small>
            </div>
        </div>
    </div>

    <div id="actions" class="row">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="index.php" class="btn btn-default">Cancelar</a>
    </div>
</form>

<?php include(FOOTER_TEMPLATE); ?>