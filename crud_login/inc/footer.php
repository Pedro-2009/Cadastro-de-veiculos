</main> <!-- /container -->

<hr>
<footer class="container">
    <p>&copy;2025 - Senac PR - Prof. Djonatan Piehowiak</p>
</footer>

<?php
// Inclui todos os modais PHP
foreach (glob(COMPONENTS_PATH . 'modal/*.php') as $modalFile) {
    include $modalFile;
}
?>

<!-- Bootstrap 5 bundle (inclui Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<!-- Opcional: manter jQuery temporariamente se seus scripts ainda dependem (comente se já reescreveu) -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- Seus scripts -->
<script src="<?php echo JS_URL; ?>main.js"></script>
<script src="<?php echo JS_URL; ?>mascaras.js"></script>
<script src="<?php echo JS_URL; ?>buscaCEP.js"></script>

<!-- Scripts custom dos modais (se existir lógica específica) -->
<script src="<?php echo COMPONENTS_URL; ?>modal/modal.js"></script>
<script src="<?php echo COMPONENTS_URL; ?>modal/deleteModal.js"></script>

<script>
    const FORGOT_PASSWORD_URL = "<?php echo MODULES_URL; ?>users/forgot_password.php";
</script>
<script src="<?php echo JS_URL; ?>forgotPassword.js"></script>

</body>
</html>
