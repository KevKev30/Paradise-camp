function prix_total() {
    const activite = document.getElementById("activite").value;
    const cantine = document.getElementById("cantine").value;
    const arcade = document.getElementById("arcade").value;
    const id = document.querySelector("input[name='id']").value;

    fetch(`details.php?ajax=prix&id=${id}&activite=${activite}&cantine=${cantine}&arcade=${arcade}`)
        .then(response => response.json())
        .then(data => {
            if (data.prix !== undefined) {
                document.getElementById("prix_total").textContent = data.prix + "€";
            } else {
                document.getElementById("prix_total").textContent = "Erreur serveur";
                console.error(data.erreur);
            }
        })
        .catch(erreur => {
            document.getElementById("prix_total").textContent = "Erreur serveur";
            console.error("Erreur AJAX :", erreur);
        });
}

window.addEventListener("DOMContentLoaded", () => {
    const personnes = parseInt(document.getElementById("options-bloc").dataset.personnes);

    const creerSelect = (id, nomOptions) => {
        const select = document.createElement("select");
        select.name = nomOptions;
        select.id = nomOptions;

        for (let i = 0; i <= personnes; i++) {
            const option = document.createElement("option");
            option.valeur = i;
            option.textContent = i;
            select.appendChild(option);
        }

        document.getElementById(id).appendChild(select);
        select.addEventListener("change", prix_total);
    };

    creerSelect("activite-bloc", "activite");
    creerSelect("cantine-bloc", "cantine");
    creerSelect("arcade-bloc", "arcade");

    prix_total(); 
});
