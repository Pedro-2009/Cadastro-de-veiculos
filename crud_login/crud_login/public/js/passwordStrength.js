$(document).ready(function() {
    function getPasswordStrength(val) {
        let strength = 0;
        if (val.length >= 6) strength++;
        if (/[A-Z]/.test(val) && /[0-9]/.test(val)) strength++;
        if (/[\W]/.test(val)) strength++;
        return strength;
    }

    function updatePasswordStrength(val, barSelector, textSelector) {
        const strength = getPasswordStrength(val);
        const bar = $(barSelector);
        const text = $(textSelector);
        bar.removeClass('strength-weak strength-medium strength-strong');

        if (strength <= 1) {
            bar.addClass('strength-weak');
            text.text('Fraca');
        } else if (strength == 2) {
            bar.addClass('strength-medium');
            text.text('Média');
        } else {
            bar.addClass('strength-strong');
            text.text('Forte');
        }
    }

    function checkConfirmPassword(val) {
        const passwordVal = $('#password').val();
        const confirmBar = $('#confirmStrength');
        const confirmText = $('#confirmStrengthText');

        if (!val) {
            confirmBar.removeClass('strength-weak strength-medium strength-strong');
            confirmText.text('');
            return;
        }

        if (val !== passwordVal) {
            confirmBar.removeClass('strength-medium strength-strong').addClass('strength-weak');
            confirmText.text('Não coincide');
        } else {
            updatePasswordStrength(val, '#confirmStrength', '#confirmStrengthText');
        }
    }

    $('#password').on('input', function() {
        updatePasswordStrength($(this).val(), '#passwordStrength', '#passwordStrengthText');
        const confirmVal = $('#confirm_password').val();
        if (confirmVal) checkConfirmPassword(confirmVal);
    });

    $('#confirm_password').on('input', function() {
        checkConfirmPassword($(this).val());
    });

    $('.toggle-password').click(function() {
        const input = $($(this).data('target'));
        const type = input.attr('type') === 'password' ? 'text' : 'password';
        input.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });
});
