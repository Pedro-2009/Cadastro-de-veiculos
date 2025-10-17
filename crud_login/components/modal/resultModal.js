document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const message = body.dataset.message || '';
    const type = body.dataset.type || 'info';
    const redirect = body.dataset.redirect || null;

    if (!message) return;

    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalOkBtn = document.getElementById('modalOkBtn');

    modalTitle.innerText = type === 'success' ? 'Sucesso' : 'Erro';
    modalMessage.innerText = message;
    modalMessage.className = `alert alert-${type}`;

    // Mostra o modal (Bootstrap 3 usa jQuery internamente)
    $('#resultModal').modal('show');

    // Redireciona ao clicar no OK se houver redirect
    modalOkBtn.addEventListener('click', function() {
        if (redirect) {
            window.location.href = redirect;
        }
    });
});