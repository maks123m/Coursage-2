document.addEventListener('DOMContentLoaded', () => {
    const row = document.querySelector('.cards-row');
    const leftBtn = document.querySelector('.arrow-btn.left');
    const rightBtn = document.querySelector('.arrow-btn.right');

    if (!row || !leftBtn || !rightBtn) return;

    const gap = parseFloat(getComputedStyle(row).gap) || 0;
    const step = () => (row.firstElementChild ? row.firstElementChild.offsetWidth + gap : 300);

    const setStates = () => {
        const rowRect = row.getBoundingClientRect();
        const rowCenter = rowRect.left + row.clientWidth / 2;

        let best = null;
        let bestDist = Infinity;
        let bestIndex = -1;

        // 1. Находим самую центральную карточку
        for (let i = 0; i < row.children.length; i++) {
            const card = row.children[i];
            const r = card.getBoundingClientRect();
            const dist = Math.abs(r.left + r.width / 2 - rowCenter);
            
            if (dist < bestDist) {
                bestDist = dist;
                best = card;
                bestIndex = i;
            }
        }

        // 2. Сбрасываем классы у всех
        for (const card of row.children) {
            card.classList.remove('active', 'neighbor');
        }

        // 3. Назначаем классы
        if (best) {
            best.classList.add('active');
            
            // Находим соседей (учитываем цикличность массива)
            const cards = Array.from(row.children);
            const total = cards.length;
            
            // Левый сосед
            const leftNeighborIndex = (bestIndex - 1 + total) % total;
            cards[leftNeighborIndex].classList.add('neighbor');
            
            // Правый сосед
            const rightNeighborIndex = (bestIndex + 1) % total;
            cards[rightNeighborIndex].classList.add('neighbor');
        }
    };

    const instant = (fn) => {
        const prev = row.style.scrollBehavior;
        row.style.scrollBehavior = 'auto';
        fn();
        row.style.scrollBehavior = prev;
    };

    let busy = false;

    rightBtn.addEventListener('click', () => {
        if (busy) return;
        busy = true;

        row.scrollBy({ left: step(), behavior: 'smooth' });

        setTimeout(() => {
            instant(() => {
                row.appendChild(row.firstElementChild);
                row.scrollLeft -= step();
            });
            setStates();
            busy = false;
        }, 450);
    });

    leftBtn.addEventListener('click', () => {
        if (busy) return;
        busy = true;

        instant(() => {
            row.insertBefore(row.lastElementChild, row.firstElementChild);
            row.scrollLeft += step();
        });

        requestAnimationFrame(() => {
            row.scrollBy({ left: -step(), behavior: 'smooth' });
        });

        setTimeout(() => {
            setStates();
            busy = false;
        }, 450);
    });

    // Инициализация при загрузке
    setStates();
});
