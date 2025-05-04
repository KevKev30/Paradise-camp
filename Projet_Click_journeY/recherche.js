function optionSelectionnee(name){
    let dest = document.getElementById(name);
    return dest.value;
}

function filtrerRecherches(liste_voyages){
    let dest = optionSelectionnee("destination");
    let arrivee = optionSelectionnee("arrivee");
    let depart = optionSelectionnee("depart");
    let personnes = parseInt(optionSelectionnee("personnes"));
    let hebergement = optionSelectionnee("hebergement");
    let prix = parseInt(optionSelectionnee("prix"));

    if (arrivee == ""){
        arrivee = "2025-06-01";
    }
    if (depart == ""){
        depart = "2025-08-31";
    }

    let da1 = new Date(arrivee).getTime();
    let da2 = new Date(liste_voyages.voyages.arrivee).getTime();

    let dd1 = new Date(depart).getTime();
    let dd2 = new Date(liste_voyages.voyages.depart).getTime();

    let resultat = ``;

    liste_voyages.voyages.forEach(
        voyage => {
            if (
                (dest == "" || dest == voyage.destination) &&
                (hebergement == "" || hebergement == voyage.hebergement) &&
                (prix == 0 || prix == parseInt(voyage.prix)) &&
                (personnes == 0 ||personnes == parseInt(voyage.personnes)) &&
                ((da2 - da1) / (1000 * 60 * 60 * 24) >= 0) || ((dd2 - dd1) / (1000 * 60 * 60 * 24) >= 0) 
            ){

                let lien = document.createElement("a");
                lien.href = `details.php?id=${voyage.id} class="selection_lien"`;

                let contenu = document.createElement("div");
                contenu.className = 'selection1';

                contenu.innerHTML = 
                `
                <img class="photo" src="${voyage.image}">
                <p> ${voyage.nom} - ${voyage.destination}
                <br>
                Nombre de personnes : ${voyage.personnes}
                <br>
                Prix/nuit: ${voyage.prix}€
                <br>
                Durée : ${voyage.duree} jours</p>
                `

                lien.appendChild(contenu);
            }
        }
    )
    getElementById("resultats").appendChild(lien);
}