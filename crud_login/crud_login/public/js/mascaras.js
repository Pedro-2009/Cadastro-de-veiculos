// Função que aplica a máscara de acordo com o tipo
function aplicarMascara(input, tipo) {
    let valor = input.value.replace(/\D/g, ""); // Remove tudo que não for número

    switch (tipo) {
        case "cpf":
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
            break;

        case "zip_code":
            valor = valor.replace(/(\d{2})(\d)/, "$1.$2");
            valor = valor.replace(/(\d{3})(\d{1,3})$/, "$1-$2");
            break;

        case "phone":
            valor = valor.replace(/^(\d{2})(\d)/, "($1)$2");
            valor = valor.replace(/(\d{4})(\d{1,4})$/, "$1-$2");
            break;

        case "mobile":
            valor = valor.replace(/^(\d{2})(\d)/, "($1)$2");
            valor = valor.replace(/(\d{5})(\d{1,4})$/, "$1-$2");
            break;
    }

    input.value = valor;
}

// Aplica máscara automaticamente para inputs com data-mask
document.addEventListener("input", function (e) {
    if (e.target.hasAttribute("data-mask")) {
        aplicarMascara(e.target, e.target.getAttribute("data-mask"));
    }
});