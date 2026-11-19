document.addEventListener('DOMContentLoaded', function() {
    const openBtn = document.getElementById('discussion');
    const modal = document.getElementById('feedbackModal');
    const closeBtn = document.getElementById('closeFeedbackModal');

    if (openBtn && modal) {
        openBtn.addEventListener('click', function() {
            modal.style.display = 'flex';
        });
    }

    if (closeBtn && modal) {
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }

    if (modal) {
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    }
});