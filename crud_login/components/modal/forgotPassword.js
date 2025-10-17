$(document).ready(function () {
    const $form = $('#forgotPasswordForm');
    const $stepEmail = $('#step-email');
    const $stepPassword = $('#step-password');
    const $forgotEmail = $('#forgotEmail');
    const $newPassword = $('#new_password');
    const $confirmPassword = $('#confirm_password');
    const $hiddenEmail = $('#hiddenEmail'); // ⚡ campo hidden agora correto

    function showMessage(message, type = 'danger') {
        $('#forgotPasswordForm .alert').remove();
        const alertHtml = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>`;
        $form.prepend(alertHtml);
    }

    $form.on('submit', function (e) {
        e.preventDefault();

        // =========================
        // Etapa 1: validação de e-mail
        // =========================
        if ($stepEmail.is(':visible')) {
            const email = $forgotEmail.val().trim();
            if (!email) return showMessage('Informe seu e-mail.');

            $.post($form.attr('action'), { step: 'checkEmail', email: email }, function (response) {
                if (response.status === 'success') {
                    $stepEmail.hide();
                    $stepPassword.show();
                    $hiddenEmail.val(email); // ⚡ grava o email no hidden
                    showMessage('E-mail válido! Informe a nova senha.', 'success');
                } else {
                    showMessage(response.message, 'danger');
                }
            }, 'json').fail(function () {
                showMessage('Erro ao verificar e-mail.', 'danger');
            });

        // =========================
        // Etapa 2: redefinir senha
        // =========================
        } else if ($stepPassword.is(':visible')) {
            const email = $hiddenEmail.val();
            const password = $newPassword.val().trim();
            const confirm = $confirmPassword.val().trim();

            if (!password || !confirm) return showMessage('Preencha ambos os campos de senha.');
            if (password !== confirm) return showMessage('As senhas não coincidem.');

            $.post($form.attr('action'), {
                hidden_email: email,
                password: password,
                confirm_password: confirm
            }, function () {
                const modal = bootstrap.Modal.getInstance(document.getElementById('forgotPasswordModal'));
                modal.hide();
                window.location.href = BASEURL + "login.php";
            }).fail(function () {
                showMessage('Erro ao redefinir senha.', 'danger');
            });
        }
    });

    // Toggle de senha
    $('.toggle-password').on('click', function () {
        const target = $($(this).data('target'));
        const type = target.attr('type') === 'password' ? 'text' : 'password';
        target.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });
});
