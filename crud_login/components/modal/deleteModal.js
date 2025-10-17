function openDeleteModal(deleteUrl) {
    const modalEl = document.getElementById('deleteModal');
    const confirmBtn = modalEl.querySelector('#confirmDeleteBtn');

    // Atualiza o onclick do botão confirmar
    confirmBtn.onclick = function() {
        window.location.href = deleteUrl;
    };

    // Inicializa e abre o modal usando Bootstrap 5
    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}
