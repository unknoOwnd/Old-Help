
document.addEventListener('DOMContentLoaded', function () {
    const actionCards = document.querySelectorAll('.action-card');
    const toastContainer = document.querySelector('.toast-container');

    const showToast = (message) => {
        const toastEl = document.createElement('div');
        toastEl.className = 'toast show';
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');

        toastEl.innerHTML = `
            <div class="toast-header">
                <strong class="me-auto">OldHelp Assistant</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        `;

        toastContainer.appendChild(toastEl);

        const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
        toast.show();

        toastEl.addEventListener('hidden.bs.toast', () => {
            toastEl.remove();
        });
    };

    actionCards.forEach(card => {
        card.addEventListener('click', () => {
            const task = card.getAttribute('data-task');
            showToast(`Help for <strong>${task}</strong> is on the way!`);
        });
    });
});
