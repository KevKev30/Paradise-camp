document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.action');

    buttons.forEach(button => {
        button.addEventListener('click', async () => {
            const Id_utilisateur = button.getAttribute('utilisateurID');
            const action = button.getAttribute('role');

            button.disabled = true;
            
            button.textContent = '⏳...';

            try {
                const reponse = await fetch('traitement.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ Id_utilisateur, action })
                });


                const resultat = await reponse.text();

                if (resultat === 'ok') {
                    if (action === 'bannir') {
                        button.closest('tr').remove();
                    } else {
                        button.textContent = '✓ Promu';
                        button.disabled = false;
                    }
                } else {
                    button.textContent = '❌ Erreur';
                    button.disabled = false;
                }

            } catch (e) {
                console.error("error");
                button.disabled = false;
            }
        });
    });
});
