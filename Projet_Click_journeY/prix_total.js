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
                console.error(data.error);
            }
        })
        .catch(error => {
            document.getElementById("prix_total").textContent = "Erreur serveur";
            console.error("Erreur AJAX :", error);
        });
}
