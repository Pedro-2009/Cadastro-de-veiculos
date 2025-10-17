  // ---------------------------
  // Exibe e oculta senha
  // ---------------------------
document.addEventListener('DOMContentLoaded', () => {
  const toggleButtons = document.querySelectorAll('.toggle-password');

  toggleButtons.forEach((button) => {
    button.addEventListener('click', () => {
      const targetSelector = button.dataset.target;
      const input = document.querySelector(targetSelector);

      if (!input) return;

      const isPassword = input.type === 'password';
      input.type = isPassword ? 'text' : 'password';

      button.innerHTML = isPassword
        ? '<i class="fa fa-eye-slash" aria-hidden="true"></i>'
        : '<i class="fa fa-eye" aria-hidden="true"></i>';

      button.setAttribute('aria-label', isPassword ? 'Ocultar senha' : 'Mostrar senha');
    });
  });

  // ---------------------------
  // Validação de campos
  // ---------------------------

  const loginButton = document.getElementById("loginButton");
  const requiredInputs = document.querySelectorAll("[required]");

  function validarCampo(input) {
    if (input.value.trim() === "") {
      input.setAttribute("placeholder", "Este campo é obrigatório.");
      input.classList.add("error");
      input.style.borderColor = "red";
      input.style.borderWidth = "2px";
      return false;
    } else {
      limparErro(input);
      return true;
    }
  }

  function limparErro(input) {
    input.classList.remove("error");
    input.style.borderColor = "#ccc";
    input.style.borderWidth = "1px";
    input.setAttribute("placeholder", input.dataset.placeholder || " ");
  }

  function validarTodosCampos() {
    let isValid = true;
    requiredInputs.forEach((input) => {
      if (!validarCampo(input)) isValid = false;
    });
    return isValid;
  }

  requiredInputs.forEach((input) => {
    input.dataset.placeholder = input.placeholder;
    input.addEventListener("blur", () => validarCampo(input));
    input.addEventListener("input", () => limparErro(input));
  });

  loginButton.addEventListener("click", () => {
    if (validarTodosCampos()) {
      alert("Login efetuado com sucesso!");
    }
  });
});
