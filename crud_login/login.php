<?php
require_once __DIR__ . '/init.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login - Sistema CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>loginStyles.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>passwordStyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>

<div class="container py-4">
    <div class="login-container mx-auto" style="max-width: 400px;">
        <h2 class="text-center mb-4">Acessar Sistema</h2>

        <?php if (!empty($_SESSION['messages'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['messages']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
            <?php clear_messages(); ?>
        <?php endif; ?>

        <form action="<?php echo BASEURL; ?>auth.php" method="post">
            <div class="mb-3">
                <label for="login" class="form-label">Usuário ou E-mail</label>
                <input type="text" id="login" name="login" class="form-control" placeholder="Digite seu usuário ou e-mail" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Digite sua senha" required>
                    <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-target="#password">
                        <i class="fa fa-eye fs-5"></i>
                    </button>
                </div>
            </div>

            <button type="submit" id="loginButton" class="btn btn-primary w-100">Entrar</button>

            <div class="login-footer mt-3 d-flex justify-content-between">
                <a href="<?php echo MODULES_URL; ?>users/register.php">Criar conta</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Esqueceu a senha?</a>
            </div>
        </form>
    </div>
</div>

<?php
// Inclui todos os modais
foreach (glob(COMPONENTS_PATH . 'modal/*.php') as $modalFile) {
    include $modalFile;
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo JS_URL; ?>verifica.js"></script>
<script src="<?php echo JS_URL; ?>passwordStrength.js"></script>
<script src="<?php echo COMPONENTS_URL; ?>modal/resultModal.js"></script>
<script>
    const FORGOT_PASSWORD_URL = "<?php echo MODULES_URL; ?>users/forgot_password.php";
</script>
<script src="<?php echo JS_URL; ?>forgotPassword.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
