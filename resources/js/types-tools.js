const row = document.querySelector('.cards-row');
const leftBtn = document.querySelector('.arrow-btn.left');
const rightBtn = document.querySelector('.arrow-btn.right');

if (row && leftBtn && rightBtn) {
    const getStep = () => {
        const card = row.querySelector('.type-card');
        if (!card) return 300;
        const gap = parseFloat(getComputedStyle(row).gap) || 0;
        return card.offsetWidth + gap;
    };

    leftBtn.addEventListener('click', () => {
        row.scrollBy({ left: -getStep(), behavior: 'smooth' });
    });

    rightBtn.addEventListener('click', () => {
        row.scrollBy({ left: getStep(), behavior: 'smooth' });
    });
}
