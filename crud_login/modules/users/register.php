<?php
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['user'])) {
  register(); // Agora define $_SESSION['messages'] e $_SESSION['type'] para o modal
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>Criar Conta - Sistema CRUD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="<?php echo CSS_URL; ?>bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo CSS_URL; ?>loginStyles.css" />
  <link rel="stylesheet" href="<?php echo CSS_URL; ?>passwordStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body data-message="<?php echo addslashes($_SESSION['messages'] ?? ''); ?>"
  data-type="<?php echo $_SESSION['type'] ?? ''; ?>"
  data-redirect="<?php echo BASEURL; ?>login.php">
  <?php clear_messages(); ?>

  <div class="login-container">
    <h2 class="text-center">Criar Conta</h2>
    <form method="post" action="register.php">
      <div class="form-group">
        <label for="name">Nome completo</label>
        <input type="text" id="name" class="form-control" name="user[name]" required />
      </div>
      <div class="form-group">
        <label for="username">Usuário</label>
        <input type="text" id="username" class="form-control" name="user[username]" required />
      </div>
      <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" id="email" class="form-control" name="user[email]" required />
      </div>

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
        <div id="passwordStrength" class="help-block"></div>
      </div>

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
        <div id="passwordStrength" class="help-block"></div>
      </div><br>
      <div class="form-group text-right">
        <a href="<?php echo BASEURL; ?>login.php" class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-primary">Registrar</button>
      </div

        </form>
  </div>

  <?php include(COMPONENTS_PATH . 'modal/resultModal.php'); ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="<?php echo JS_URL; ?>passwordStrength.js"></script>
  <script src="<?php echo COMPONENTS_URL; ?>modal/resultModal.js"></script>

</body>

</html>>