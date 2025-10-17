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

    <div class="login-container">
        <h2>Acessar Sistema</h2>

        <?php if (!empty($_SESSION['messages'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_SESSION['messages']; ?>
            </div>
            <?php clear_messages(); ?>
        <?php endif; ?>

        <form action="<?php echo BASEURL; ?>auth.php" method="post">
            <div class="form-group">
                <label for="login">Usuário ou E-mail</label>
                <input type="text" id="login" name="login" class="form-control" placeholder="Digite seu usuário ou e-mail" required>
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Digite sua senha" required />
                    <button type="button" class="toggle-password" data-target="#password">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" id="loginButton" class="btn btn-primary btn-block">Entrar</button>

            <div class="login-footer">
                <a href="<?php echo MODULES_URL; ?>users/register.php">Criar conta</a>
                <!-- <a href="<?php echo BASEURL; ?>forgot_password.php">Esqueceu a senha?</a> -->
                <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#forgotPasswordModal">Esqueceu a senha?</a> -->
                <!-- <a href="#" id="openForgotPassword" role="button" data-toggle="modal" data-target="#forgotPasswordModal">Esqueceu a senha?</a> -->
                <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">Esqueceu a senha?</a>
            </div>
        </form>
    </div>

    <?php
    // Inclui todos os modais
    foreach (glob(COMPONENTS_PATH . 'modal/*.php') as $modalFile) {
        include $modalFile;
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="<?php echo JS_URL; ?>verifica.js"></script>
    <script src="<?php echo JS_URL; ?>passwordStrength.js"></script>
    <script src="<?php echo COMPONENTS_URL; ?>modal/resultModal.js"></script>

    <script>
        const FORGOT_PASSWORD_URL = "<?php echo MODULES_URL; ?>users/forgot_password.php";
    </script>
    <script src="<?php echo JS_URL; ?>forgotPassword.js"></script>

</body>

</html>