</main> <!-- /container -->

<hr>
<footer class="container">
    <p>&copy;2025 - Senac PR - Prof. Djonatan Piehowiak</p>
</footer>

<?php
// Inclui todos os modais
foreach (glob(COMPONENTS_PATH . 'modal/*.html') as $modalFile) {
    include $modalFile;
}
?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="<?php echo JS_URL; ?>main.js"></script>
<script src="<?php echo JS_URL; ?>mascaras.js"></script>
<script src="<?php echo JS_URL; ?>buscaCEP.js"></script>
<script src="<?php echo COMPONENTS_URL; ?>modal/modal.js"></script>
<script src="<?php echo COMPONENTS_URL; ?>modal/deleteModal.js"></script>

<script>
    const FORGOT_PASSWORD_URL = "<?php echo MODULES_URL; ?>users/forgot_password.php";
</script>
<script src="<?php echo JS_URL; ?>forgotPassword.js"></script>

</body>

</html>