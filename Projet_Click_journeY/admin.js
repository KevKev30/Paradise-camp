document.addEventListener('DOMContentLoaded', function() {
    const bouttonPromotion = document.querySelectorAll('.vip');
    const bouttonBan = document.querySelectorAll('.ban');

    bouttonPromotion.forEach(button => {
        button.addEventListener('click', () => {
            button.disabled = true;
            button.textContent = 'Promotion en cours...';
            setTimeout(() => {
                button.disabled = false;
                button.textContent = 'promu ✔';
            }, 2500);
        });
    });

    bouttonBan.forEach(button => {
        button.addEventListener('click', () => {
                button.disabled = true;
                button.textContent = 'Bannissement en cours...';
                setTimeout(() => {
                    button.disabled = false;
                    button.textContent = 'Banni ✘ ';
                }, 2500);
        });
    });
});

