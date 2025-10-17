function limpaFormularioCEP() {
    document.getElementById('rua').value = "";
    document.getElementById('bairro').value = "";
    document.getElementById('cidade').value = "";
    document.getElementById('uf').value = "";
}

async function pesquisacep(cepValor) {
    // Remove tudo que não for número
    const cep = cepValor.replace(/\D/g, '');

    if (cep === "") {
        limpaFormularioCEP();
        return;
    }

    // Validação do CEP
    const validacep = /^[0-9]{8}$/;
    if (!validacep.test(cep)) {
        limpaFormularioCEP();
        alert("Formato de CEP inválido.");
        return;
    }

    // Preenche campos com "..." enquanto busca
    document.getElementById('rua').value = "...";
    document.getElementById('bairro').value = "...";
    document.getElementById('cidade').value = "...";
    document.getElementById('uf').value = "...";

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if ("erro" in data) {
            limpaFormularioCEP();
            alert("CEP não encontrado.");
        } else {
            document.getElementById('rua').value = data.logradouro;
            document.getElementById('bairro').value = data.bairro;
            document.getElementById('cidade').value = data.localidade;
            document.getElementById('uf').value = data.uf;
        }
    } catch (error) {
        limpaFormularioCEP();
        alert("Erro ao consultar o CEP. Tente novamente.");
        console.error(error);
    }
}
