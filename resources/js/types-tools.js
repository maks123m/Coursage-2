document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.cards-row');
    const leftBtn = document.querySelector('.arrow-btn.left');
    const rightBtn = document.querySelector('.arrow-btn.right');

    if (!slider || !leftBtn || !rightBtn) return;

    const scrollAmount = 300;

    leftBtn.addEventListener('click', () => {
        slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    });

    rightBtn.addEventListener('click', () => {
        slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    });
});