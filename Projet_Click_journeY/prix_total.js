function prix_total(){
    let prix_total = document.getElementById("prix_total");
    prix_total.textContent = 
    parseInt(prix_total.dataset.extra) + 
    parseInt(document.getElementById("activite").value) * 60 + 
    parseInt(document.getElementById("cantine").value) * 40 + 
    parseInt(document.getElementById("arcade").value) * 10;
}