$(document).ready(function() {

  // Alterna visibilidade da senha
  $(".toggle-password").click(function() {
    const input = $($(this).data("target"));
    const icon = $(this).find("i");
    if (input.attr("type") === "password") {
      input.attr("type", "text");
      icon.removeClass("fa-eye").addClass("fa-eye-slash");
    } else {
      input.attr("type", "password");
      icon.removeClass("fa-eye-slash").addClass("fa-eye");
    }
  });

  // Verifica força da senha
  // function updatePasswordStrength(password, strengthElement) {
  //   let strength = "Fraca";
  //   let color = "red";

  //   if (password.length >= 8 && /[A-Z]/.test(password) && /\d/.test(password)) {
  //     strength = "Forte";
  //     color = "green";
  //   } else if (password.length >= 6) {
  //     strength = "Média";
  //     color = "orange";
  //   }

  //   $(strengthElement).text("Força da senha: " + strength).css("color", color);
  // }

  // Verifica se as senhas coincidem
  function checkConfirmPassword() {
    const pass = $("#new_password").val();
    const confirm = $("#confirm_password").val();
    const confirmStrength = $("#confirmStrength");

    if (!confirm) {
      confirmStrength.text("");
      return;
    }

    if (pass !== confirm) {
      confirmStrength.text("As senhas não coincidem").css("color", "red");
    } else {
      confirmStrength.text("Senhas coincidem").css("color", "green");
    }
  }

  // Atualiza força da senha ao digitar
  $("#new_password").on("input", function() {
    updatePasswordStrength($(this).val(), "#passwordStrength");
    checkConfirmPassword();
  });

  // Verifica confirmação da senha ao digitar
  $("#confirm_password").on("input", function() {
    checkConfirmPassword();
  });

  // Controle do fluxo do formulário
  $("#forgotPasswordForm").on("submit", function(e) {
    if ($("#step-email").is(":visible")) {
      e.preventDefault();

      const email = $("#forgotEmail").val();

      $.post("modules/users/forgot_password.php", { email: email, step: "checkEmail" }, function(response) {
        if (response.status === "success") {
          $("#hiddenEmail").val(email);
          $("#step-email").hide();
          $("#step-password").show();
          $("#btnSubmitForgot").text("Redefinir Senha");
        } else {
          alert(response.message);
        }
      }, "json").fail(function() {
        alert("Erro ao comunicar com o servidor.");
      });

    } else {
      const pass = $("#new_password").val();
      const confirm = $("#confirm_password").val();

      if (pass.length < 6) {
        e.preventDefault();
        alert("A senha deve ter pelo menos 6 caracteres.");
        return;
      }

      if (pass !== confirm) {
        e.preventDefault();
        alert("As senhas não coincidem.");
        return;
      }
      // Envia normalmente para o PHP processar
    }
  });

});
