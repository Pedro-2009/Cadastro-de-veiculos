function openDeleteModal(deleteUrl) {
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    confirmBtn.setAttribute('href', deleteUrl);

    // Exibe o modal
    $('#deleteModal').modal('show');
}
