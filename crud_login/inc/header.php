<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap 5.3.8 CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Seus CSS -->
  <link rel="stylesheet" href="<?php echo CSS_URL; ?>headerStyles.css">
  <link rel="stylesheet" href="<?php echo COMPONENTS_URL; ?>modal/modal.css">
  <link rel="stylesheet" href="<?php echo CSS_URL; ?>passwordStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <title>CRUD com Bootstrap</title>
</head>

<body>
  <!-- NAVBAR (Bootstrap 5) -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php">CRUD</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Alternar navegação">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="clientesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Clientes
            </a>
            <ul class="dropdown-menu" aria-labelledby="clientesDropdown">
              <li><a class="dropdown-item" href="<?php echo MODULES_URL; ?>customers">Gerenciar Clientes</a></li>
              <li><a class="dropdown-item" href="<?php echo MODULES_URL; ?>customers/add.php">Novo Cliente</a></li>
            </ul>
          </li>

          <?php if (in_array($_SESSION['user']['access_level'], ['admin', 'funcionario'])): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="usuariosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Usuários
            </a>
            <ul class="dropdown-menu" aria-labelledby="usuariosDropdown">
              <li><a class="dropdown-item" href="<?php echo MODULES_URL; ?>users">Gerenciar Usuários</a></li>
              <li><a class="dropdown-item" href="<?php echo MODULES_URL; ?>users/add.php">Novo Usuário</a></li>
            </ul>
          </li>
          <?php endif; ?>
        </ul>

        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="perfilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user me-1"></i> <?php echo htmlspecialchars($_SESSION['user']['name']); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="perfilDropdown" style="min-width: 300px;">
              <li class="dropdown-header">Perfil</li>
              <li class="px-2"><strong>Nome:</strong> <?php echo htmlspecialchars($_SESSION['user']['name']); ?></li>
              <li class="px-2"><strong>Usuário:</strong> <?php echo htmlspecialchars($_SESSION['user']['username']); ?></li>
              <li class="px-2"><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user']['email']); ?></li>
              <li class="px-2"><strong>Nível:</strong> <?php echo htmlspecialchars($_SESSION['user']['access_level']); ?></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?php echo MODULES_URL; ?>users/edit.php?id=<?php echo $_SESSION['user']['id']; ?>"><i class="fa fa-id-card me-1"></i> Editar Perfil</a></li>
              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal"><i class="fa fa-key me-1"></i> Alterar Senha</a></li>
              <li><a class="dropdown-item" href="<?php echo BASEURL; ?>logout.php"><i class="fa fa-sign-out me-1"></i> Sair</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container" style="padding-top:80px;">
