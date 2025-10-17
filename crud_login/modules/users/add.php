<?php 
require_once('functions.php');
requireAccess(['admin', 'funcionario']);
add();
?>

<?php include(HEADER_TEMPLATE); ?>

<div class="container py-4">
  <h2 class="text-center mb-4">Novo Usuário</h2>

  <form action="add.php" method="post" class="mx-auto" style="max-width: 700px;">
    
    <!-- Nome e Usuário -->
    <div class="row mb-3">
      <div class="col-md-8">
        <label for="name" class="form-label">Nome completo</label>
        <input type="text" class="form-control" name="user['name']" required>
      </div>
      <div class="col-md-4">
        <label for="username" class="form-label">Usuário</label>
        <input type="text" class="form-control" name="user['username']" required>
      </div>
    </div>

    <!-- E-mail e Nível de Acesso -->
    <div class="row mb-3">
      <div class="col-md-8">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" name="user['email']" required>
      </div>
      <div class="col-md-4">
        <label for="access_level" class="form-label">Nível de Acesso</label>
        <select class="form-select" name="user['access_level']" required>
          <option value="" disabled selected>Selecione</option>
          <option value="admin">Administrador</option>
          <option value="funcionario">Funcionário</option>
          <option value="cliente">Cliente</option>
        </select>
      </div>
    </div>

    <!-- Senha e Confirmar Senha -->
    <div class="row mb-3 g-3">
      <div class="col-md-6">
        <label for="password" class="form-label">Senha</label>
        <div class="input-group">
          <input type="password" id="password" class="form-control" name="user[password]" required>
          <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-target="#password">
            <i class="fa fa-eye fs-5"></i>
          </button>
        </div>
        <div class="password-strength mt-1" id="passwordStrength"></div>
        <small id="passwordStrengthText" class="text-muted"></small>
      </div>

      <div class="col-md-6">
        <label for="confirm_password" class="form-label">Confirmar Senha</label>
        <div class="input-group">
          <input type="password" id="confirm_password" class="form-control" name="user[confirm_password]" required>
          <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-target="#confirm_password">
            <i class="fa fa-eye fs-5"></i>
          </button>
        </div>
        <div class="password-strength mt-1" id="confirmStrength"></div>
        <small id="confirmStrengthText" class="text-muted"></small>
      </div>
    </div>

    <!-- Botões -->
    <div class="d-flex justify-content-center mt-4">
      <button type="submit" class="btn btn-primary me-2">Salvar</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>

  </form>
</div>

<?php include(FOOTER_TEMPLATE); ?>
