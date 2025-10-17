<?php
    require_once('functions.php');
    view($_GET['id']);
?>

<?php include(HEADER_TEMPLATE); ?>
 
<h2>Usuário: <?php echo $user['name']; ?></h2>

<hr> 

<?php if (!empty($_SESSION['messages'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['messages']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
    <dt>Nome completo:</dt>
    <dd><?php echo $user['name']; ?></dd>

    <dt>Username:</dt>
    <dd><?php echo $user['username']; ?></dd>

    <dt>e-mail</dt>
    <dd><?php echo $user['email']; ?></dd>

    <dt>Nível de Acesso:</dt>
    <dd><?php echo $user['access_level']; ?></dd>
</dl>

<dl class="dl-horizontal">
    <dt>Data do Cadastro:</dt>
    <dd><?php echo formatDateTimeForView($user['created']); ?></dd>
    <dt>Atualizado em:</dt>
    <dd><?php echo formatDateTimeForView($user['modified']); ?></dd>
</dl>

<div id="actions" class="row">
    <div class="col-md-2">
        <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-primary">Editar</a>
        <a href="index.php" class="btn btn-default">Voltar</a>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>