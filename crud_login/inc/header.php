<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo CSS_URL; ?>bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo CSS_URL; ?>headerStyles.css">
  <link rel="stylesheet" href="<?php echo COMPONENTS_URL; ?>modal/modal.css">
  <link rel="stylesheet" href="<?php echo CSS_URL; ?>passwordStyles.css">
  <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>CRUD com Bootstrap</title>
</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="<?php echo BASEURL; ?>index.php" class="navbar-brand">CRUD</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              Clientes <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo MODULES_URL; ?>customers">Gerenciar Clientes</a></li>
              <li><a href="<?php echo MODULES_URL; ?>customers/add.php">Novo Cliente</a></li>
            </ul>
          </li>
          <?php if (in_array($_SESSION['user']['access_level'], ['admin', 'funcionario'])): ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Usuários <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo MODULES_URL; ?>users">Gerenciar Usuários</a></li>
                <li><a href="<?php echo MODULES_URL; ?>users/add.php">Novo Usuário</a></li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user"></i> <?php echo htmlspecialchars($_SESSION['user']['name']); ?> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" style="width: 300px; padding: 10px;">
              <li class="dropdown-header">Perfil</li>
              <li><a href="#"><strong>Nome:</strong> <?php echo htmlspecialchars($_SESSION['user']['name']); ?></a></li>
              <li><a href="#"><strong>Usuário:</strong> <?php echo htmlspecialchars($_SESSION['user']['username']); ?></a></li>
              <li><a href="#"><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user']['email']); ?></a></li>
              <li><a href="#"><strong>Nível:</strong> <?php echo htmlspecialchars($_SESSION['user']['access_level']); ?></a></li>
              <li><a href="#"><strong>Criado:</strong> <?php echo formatDateTimeForView($_SESSION['user']['created']); ?></a></li>
              <li><a href="#"><strong>Atualizado:</strong> <?php echo formatDateTimeForView($_SESSION['user']['modified']); ?></a></li>
              <li class="divider"></li>
              <li><a href="<?php echo MODULES_URL; ?>users/edit.php?id=<?php echo $_SESSION['user']['id']; ?>"><i class="fa fa-id-card"></i> Editar Perfil</a></li>
              <li><a href="#" data-toggle="modal" data-target="#forgotPasswordModal"><i class="fa fa-key" aria-hidden="true"></i> Alterar Senha</a></li>
              <li><a href="<?php echo BASEURL; ?>logout.php"><i class="fa fa-sign-out"></i> Sair</a></li>
            </ul>
          </li>
        </ul>
      </div><!--/.navbar-collapse -->
    </div>
  </nav>
  <main class="container">