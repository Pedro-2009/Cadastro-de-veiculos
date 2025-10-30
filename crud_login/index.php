<?php require_once __DIR__ . '/init.php'; 
requireAccess([]);
?>

<?php include(HEADER_TEMPLATE); ?>

<?php $db = open_database(); ?>

<div class="container py-4">
  <h1 class="mb-4">Dashboard</h1>
  <hr>

  <?php if ($db) : ?> 
    <div class="row g-3">
      
      <!-- Novo Cliente -->
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <a href="<?php echo MODULES_URL; ?>customers/add.php" class="btn btn-primary w-100 py-3 shadow-sm d-flex flex-column align-items-center">
          <i class="fa fa-plus fa-3x mb-2"></i>
          <span>Novo Cliente</span>
        </a>
      </div>

      <!-- Clientes -->
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <a href="<?php echo MODULES_URL; ?>customers" class="btn btn-outline-primary w-100 py-3 shadow-sm d-flex flex-column align-items-center">
          <i class="fa fa-user fa-3x mb-2"></i>
          <span>Clientes</span>
        </a>
      </div>

      <?php if (in_array($_SESSION['user']['access_level'], ['admin', 'funcionario'])): ?>
        <!-- Novo Usuário -->
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <a href="<?php echo MODULES_URL; ?>users/add.php" class="btn btn-primary w-100 py-3 shadow-sm d-flex flex-column align-items-center">
            <i class="fa fa-user-plus fa-3x mb-2"></i>
            <span>Novo Usuário</span>
          </a>
        </div>

        <!-- Usuários -->
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <a href="<?php echo MODULES_URL; ?>users" class="btn btn-outline-primary w-100 py-3 shadow-sm d-flex flex-column align-items-center">
            <i class="fa fa-users fa-3x mb-2"></i>
            <span>Usuários</span>
          </a>
        </div>
      <?php endif; ?>

      <!-- Novo Veículo -->
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <a href="<?php echo MODULES_URL; ?>veiculos/add.php" class="btn btn-primary w-100 py-3 shadow-sm d-flex flex-column align-items-center">
          <i class="fa fa-plus fa-3x mb-2"></i>
          <span>Novo Veículo</span>
        </a>
      </div>

      <!-- Veículos -->
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <a href="<?php echo MODULES_URL; ?>veiculos" class="btn btn-outline-primary w-100 py-3 shadow-sm d-flex flex-column align-items-center">
          <i class="fa fa-car fa-3x mb-2"></i>
          <span>Veículos</span>
        </a>
      </div>

      <!-- Manutenção -->
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <a href="<?php echo MODULES_URL; ?>manutencoes" class="btn btn-outline-primary w-100 py-3 shadow-sm d-flex flex-column align-items-center">
          <i class="fa fa-wrench fa-3x mb-2"></i>
          <span>Manutenções</span>
        </a>
      </div>

    </div>
  <?php else : ?> 
    <div class="alert alert-danger mt-4" role="alert">
      <strong>ERRO:</strong> Não foi possível conectar ao banco de dados!
    </div>
  <?php endif; ?> 
</div>

<?php include(FOOTER_TEMPLATE); ?>
