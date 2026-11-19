document.addEventListener('DOMContentLoaded', function() {
    const hearts = document.querySelectorAll('.heart-btn');

    hearts.forEach(heart => {
        heart.addEventListener('click', function(e) {
            e.preventDefault();
            
            const id = this.dataset.id;
            const type = this.dataset.type;
            const icon = this.querySelector('img');

            fetch('/favorite/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ type: type, id: id })
            })
            .then(response => {
                if (response.status === 401) {
                    alert('Пожалуйста, войдите в аккаунт, чтобы добавлять в избранное.');
                    window.location.href = '/login';
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (!data) return;
                if (data.status === 'added') {
                    icon.style.filter = 'invert(1)';
                } else if (data.status === 'removed') {
                    icon.style.filter = 'none';
                }
            })
            .catch(error => console.error('Ошибка:', error));
        });
    });
});